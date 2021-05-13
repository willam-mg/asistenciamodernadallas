<?php 
namespace App\Models;

use CodeIgniter\Model;
use App\Helpers\SelectDb;

class AsistenciaInscripcion extends Model
{
    protected $table = 'asistencia_inscripcion';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $alloedFields = ['inscripcion_id','fecha','hora','observacion'];

}
