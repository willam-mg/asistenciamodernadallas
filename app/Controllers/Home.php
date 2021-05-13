<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$options = [
				'max-age'  => 3600,
				's-maxage' => 9000,
				'etag'     => 'abcde'
		];
		$this->response->setCache($options);

		if ( get_cookie('sucursal', true) ) {
			return redirect()->to('/access');
		}

		if ( $this->request->getMethod() == 'post' ) {
			try {
				$sucursal = $this->request->getPost('sucursal');
				$created = set_cookie('sucursal', $sucursal, '3600'); 
				// return var_dump($sucursal);
				// get_cookie('sucursal', true);
				// if (!$created){
				// 	return 'fdsfds';
				// 	throw new \Exception("No se cuardo el cookie");
				// }
				// return redirect()->to('/acc');
				return view('home/done');
			} catch (\Throwable $th) {
				$this->session->setFlashdata('message', $th->getMessage());
			}
			
		}	
		return view('home/index');
	}
}
