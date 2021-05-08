<?php
namespace App\Helpers;

class SelectDb 
{
    const db = 'default';
    public static function getDb() {
		// helper('cookie');
        // $sucursal = get_cookie('sucursal', true);
        // if ( $sucursal ) {
		// 	switch ($sucursal) {
        //         case 'quillacollo':
        //             // return \Config\Database::connect();
        //             return 'default';
        //             break;
        //         case 'sacaba':
        //             return 'sacaba';
        //             // return \Config\Database::connect('sacaba');
        //             break;
        //         default:
        //             return null;
        //             break;
        //     }
		// }
        return 'default';
    }
}
