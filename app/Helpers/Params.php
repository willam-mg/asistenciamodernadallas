<?php
namespace App\Helpers;

class Params 
{
    const path_server = ENVIRONMENT === 'production'?'https://asistencia.academiamodernadallas.com':'https://newmodernadallas.local:8443';
}
