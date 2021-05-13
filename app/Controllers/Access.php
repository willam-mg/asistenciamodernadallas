<?php

namespace App\Controllers;

use App\Models\AsistenciaInscripcion;
use App\Models\Inscripcion;

class Access extends BaseController
{
	public function index()
	{
		if ( !$db = $this->getDb() ) {
			return redirect()->to('/home');
		}
		$sucursal = $this->sucursal();
		
		if ( $this->request->getMethod() == 'post' ) {
			try {
				$codigo = trim($this->request->getPost('codigo'));
				if ( !$codigo ) {
					return redirect()->to('/home');
				}
				$codigoAcceso = substr($codigo, 0, -1);

				$estudiante = model('Estudiante', true, $db)
					->where('codigo', $codigoAcceso)
                  	->first();
				$inscripciones = $db->table('inscripcion')
					->where('estudiante_id', $estudiante['id'])
					->get()
					->getResultArray(); 

				if ( count($inscripciones) == 0 ) {
					throw new \Exception("El estuiante no tiene inscripciones");
				}

				if ( count($inscripciones) > 1 ) {
					return redirect()->to('/access/seleccionar/'.$estudiante['id']);
				} 

				$inscripcion = $inscripciones[0]; 
				return redirect()->to('/access/correcto/'.$inscripcion['id']);
			} catch (\Throwable $th) {
				$this->session->setFlashdata('message', $th->getMessage());
				return redirect()->to('/access/incorrecto/');
			}
		}	
		return view('access/index', [
			'sucursal'=>$sucursal
		]);
	}

	public function seleccionar($id) {
		if ( !$db = $this->getDb() ) {
			return redirect()->to('/home');
		}
		$sucursal = $this->sucursal();
		$estudiante = model('Estudiante', true, $db)->find($id);
		$inscripciones = $db->table('inscripcion')
			->select('inscripcion.id as id, plan.nombre, plan.tipo, plan_horario.inicio, plan_horario.fin, plan_horario.turno')
			->join('plan_horario', 'inscripcion.plan_horario_id = plan_horario.id')
			->join('plan', 'plan_horario.plan_id = plan.id')
			->where('inscripcion.estudiante_id', $estudiante['id'])
			->where('inscripcion.estado <>', Inscripcion::ESTADO_CONCLUIDO )
			->get()
			->getResultArray();

		if ( $this->request->getMethod() == 'post' ) {
			try {
				$index = $this->request->getPost('index');
				if ( !$index ) {
					throw new \Exception("Ingrese el numero de su inscripcion");
				}
				if ( $index === '.') {
					return redirect()->to('/home');
				}
				$index = intval($index) - 1;
				if ( $index < 0 || $index > count($inscripciones) ) {
					throw new \Exception("Numero incorrecto");
				}
				$idInscripcion = $inscripciones[$index];
				return redirect()->to('/access/correcto/'.$idInscripcion['id']);
			} catch (\Throwable $th) {
				$this->session->setFlashdata( 'message', $th->getMessage() );
			}
		}

		return view('access/seleccionar', [
			'sucursal'=>$sucursal,
			'estudiante'=>$estudiante,
			'inscripciones'=>$inscripciones
		]);
	}

	public function correcto($id) {
		if ( !$db = $this->getDb() ) {
			return redirect()->to('/home');
		}
		$sucursal = $this->sucursal();
		$inscripcion = model('Inscripcion', true, $db)->find($id);
		$estudiante = model('Estudiante', true, $db)->find($inscripcion['estudiante_id']);
		$planHorario = model('PlanHorario', true, $db)->find($inscripcion['plan_horario_id']);
		$plan = model('Plan', true, $db)->find($planHorario['plan_id']);
		$mensualidades = $db->table('mensualidad')
			->join('tb_year', 'mensualidad.year_id = tb_year.id')
			->where([
				'mensualidad.inscripcion_id'=>$inscripcion['id'],
				'mensualidad.estado'=>0,
			])->get()->getResultArray(); 
		$seminarios = $db->table('asistencia_seminario')
			->join('seminario', 'asistencia_seminario.seminario_id = seminario.id')
			->where('asistencia_seminario.estudiante_id', $estudiante['id'])
			->where('asistencia_seminario.saldo > ', 0)
			->get()->getResultArray(); 
		$casilleros = $db->table('asignacion_casillero')
			->join('casillero', 'asignacion_casillero.casillero_id = casillero.id')
			->where('asignacion_casillero.estudiante_id', $estudiante['id'])
			->where('asignacion_casillero.saldo > ', 0)
			->get()->getResultArray();

		// registrando asistencia 
		$model = $db->table('asistencia_inscripcion');
		if ( $inscripcion ) {
			$data = [
				'inscripcion_id'=>$inscripcion['id'],
				'fecha'=> date('Y-m-d'),
				'hora'=> date('Y-m-d'),
				'observacion'=> 'n',
			];
			$model->insert($data);
		}
		$lecturas = $model->where('inscripcion_id', $inscripcion['id'])
			->where('fecha', date('Y-m-d'))
			->get()
			->getResultArray();
		
		$numIngresos = count($lecturas);
		$debe = false;
		if ( count($mensualidades) > 0 || count($seminarios) > 0 || count($casilleros) > 0 ) {
			$debe = true;
		}

		return view('access/correcto', [
			'sucursal'=>$sucursal,
			'estudiante'=>$estudiante,
			'inscripcion'=>$inscripcion,
			'planHorario'=>$planHorario,
			'plan'=>$plan,
			'mensualidades'=>$mensualidades,
			'seminarios'=>$seminarios,
			'casilleros'=>$casilleros,
			'lecturas'=>$lecturas,
			'numIngresos'=>$numIngresos,
			'debe'=>$debe
		]);
	}
	
	public function incorrecto() {
		$options = [
				'max-age'  => 3600,
				's-maxage' => 9000,
				'etag'     => 'abcde'
		];
		$this->response->setCache($options);

		$sucursal = $this->sucursal();

		return view('access/incorrecto', [
			'sucursal'=>$sucursal,
		]);
	}
}
