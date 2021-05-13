<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if ( get_cookie('sucursal', true) ) {
			return redirect()->to('/access');
		}

		if ( $this->request->getMethod() == 'post' ) {
			try {
				$sucursal = $this->request->getPost('sucursal');
				$created = set_cookie('sucursal', $sucursal, '3600'); 
				return view('home/done');
			} catch (\Throwable $th) {
				$this->session->setFlashdata('message', $th->getMessage());
			}
		}	
		return view('home/index');
	}
}
