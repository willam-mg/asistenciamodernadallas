<?php

namespace App\Controllers;

class Access extends BaseController
{
	public function index()
	{
		// helper('cookie');
		$sucursal = get_cookie('sucursal', true);
		if ( !$sucursal ) {
			return redirect()->to('home');
		}

		$db = $this->selectDb($sucursal);
		// $db      = \Config\Database::connect();
		$estudiante = $db->table('estudiante');

		if ( $this->request->getMethod() == 'post' ) {
			try {
				$codigo = trim($this->request->getPost('codigo'));
				// $estudiante = new \App\Models\Estudiante();
				$estudiante = model('Estudiante', true, $db);

				$res = $estudiante
					->where('codigo', $codigo)
                  	->first();
				return var_dump($res);
				// $res = $estudiante->where('codigo', $codigo);
				// return var_dump($res->get()->getResultArray());
			} catch (\Throwable $th) {
				return $th->getMessage();
				// $this->session->setFlashdata('message', $th->getMessage());
			}
			
		}	
		return view('access/index', [
			'sucursal'=>$sucursal
		]);
	}
}
