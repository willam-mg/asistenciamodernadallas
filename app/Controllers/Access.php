<?php

namespace App\Controllers;

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
		$options = [
				'max-age'  => 3600,
				's-maxage' => 9000,
				'etag'     => 'abcde'
		];
		$this->response->setCache($options);

		$sucursal = $this->sucursal();
		echo 'Seleccionar el estudiante es: '.$id;
	}

	public function correcto($id) {
		$options = [
				'max-age'  => 3600,
				's-maxage' => 9000,
				'etag'     => 'abcde'
		];
		$this->response->setCache($options);

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

		return view('access/correcto', [
			'sucursal'=>$sucursal,
			'estudiante'=>$estudiante,
			'inscripcion'=>$inscripcion,
			'planHorario'=>$planHorario,
			'plan'=>$plan,
			'mensualidades'=>$mensualidades,
			'seminarios'=>$seminarios,
			'casilleros'=>$casilleros,
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
