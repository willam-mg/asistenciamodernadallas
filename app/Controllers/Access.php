<?php

namespace App\Controllers;

class Access extends BaseController
{
	protected function sucursal() {
		return get_cookie('sucursal', true);
	}
	protected function db() {
		$sucursal = $this->sucursal();
		if ( !$sucursal ) {
			return redirect()->to('/home');
		}
		return $this->selectDb($sucursal);
	}

	public function index()
	{
		$sucursal = $this->sucursal();
		$db = $this->db();
		if ( $this->request->getMethod() == 'post' ) {
			try {
				$codigo = trim($this->request->getPost('codigo'));
				// $estudiante = new \App\Models\Estudiante();
				$mdEstudiante = model('Estudiante', true, $db);
				$codigoAcceso = substr($codigo, 0, -1);
				$estudiante = $mdEstudiante
					->where('codigo', $codigoAcceso)
                  	->first();
				// count incripciones 
				$mdInscripcion = model('Inscripcion', true, $db);
				// return $estudiante['id'];
				$builder = $db->table('inscripcion');
				// $countInscripciones = $builder->where('estudiante_id', $estudiante['id'])->countAllResults(); 
				$inscripciones = $builder->where('estudiante_id', $estudiante['id'])->get()->getResultArray(); 

				if ( count($inscripciones) == 0 ) {
					throw new \Exception("El estuiante no tiene inscripciones");
				}

				if ( count($inscripciones) > 1 ) {
					return redirect()->to('/access/seleccionar/'.$estudiante['id']);
				} else {
					// $inscripcion = $builder->where('estudiante_id', $estudiante['id'])->first(); 
					$inscripcion = $inscripciones[0]; 
					return redirect()->to('/access/correcto/'.$inscripcion['id']);
				}
				return var_dump($query);
			} catch (\Throwable $th) {
				// return $th->getMessage();
				return redirect()->to('/access/incorrecto/');
				// $this->session->setFlashdata('message', $th->getMessage());
			}
			
		}	
		return view('access/index', [
			'sucursal'=>$sucursal
		]);
	}

	public function seleccionar($id) {
		echo 'el estudiante es: '.$id;
	}

	public function correcto($id) {
		$sucursal = $this->sucursal();
		$db = $this->db();
		$mdInscripcion = model('Inscripcion', true, $db);
		$inscripcion = $mdInscripcion->find($id);
		
		$mdEstudiante = model('Estudiante', true, $db);
		$estudiante = $mdEstudiante->find($inscripcion['estudiante_id']);
		
		$mdPlanHorario = model('PlanHorario', true, $db);
		$planHorario = $mdPlanHorario->find($inscripcion['plan_horario_id']);
		
		$mdPlan = model('Plan', true, $db);
		$plan = $mdPlan->find($planHorario['plan_id']);

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
		// return var_dump($casilleros[0]);

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
		return view('access/incorrecto');
	}
}
