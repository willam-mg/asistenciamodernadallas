<?php 
namespace App\Models;

use CodeIgniter\Model;
use App\Helpers\SelectDb;

class Estudiante extends Model
{
    // protected $DBGroup = SelectDb::getDb();
    protected $table = 'estudiante';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $alloedFields = [
        'nombre',
        'apellido',
        'ci',
        'email',
        'foto',
        'domicilio',
        'credential_entragada',
        'fecha_entrega_credencial',
        'fecha_nacimiento',
        'genero',
        'puntos',
    ];

}
