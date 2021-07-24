<?php 
namespace App\Models;

use CodeIgniter\Model;
use App\Helpers\SelectDb;

class Inscripcion extends Model
{
        /**
     * Constante para el tipo de inscripcion completo de inscripcion curso completo
     */
    const STATUS_COMPLETO = 1;

    /**
     * Constante para el tipo de inscripcion suelto de inscripcion curso suelto
     */
    const STATUS_SUELTO = 2;

    /**
     * Constante del estado de la inscripcion con el valor de 'Prosesando' = 0, 
     * se utiliza para definir un estado temporal donde aun no es una isncripcion 
     * verdadera sino que esta en proceso de inscirpcion
     */
    const ESTADO_PROCESANDO = 0;

    /**
     * Constante del estado de la inscripcion con el valor de 'Activo' = 1
     */
    const ESTADO_ACTIVO = 1;

    /**
     * Constante del estado de la inscripcion con el valor de 'Abandonado' = 2
     */
    const ESTADO_INACTIVO = 2;

    /**
     * Constante del estado de la inscripcion con el valor de 'Congelado' = 3
     */
    const ESTADO_CONGELADO = 3;

    /**
     * Constante del estado de la inscripcion con el valor de 'Concluido' = 4
     */
    const ESTADO_CONCLUIDO = 4;
    
    protected $table = 'inscripcion';
    protected $primaryKey = 'id';
    protected $returnType = 'array'; // or object
    protected $alloedFields = [
        'estudiante_id',
        'plan_horario_id',
        'matricula',
        'pago_matricula',
        'fecha',
        'costo_mensualidad',
        'fecha_inicio_clases',
        'estado',
        'tipo'
    ];

    static public function getStrEstado($estado) {
        $res = "";
        switch ($estado) {
            case self::ESTADO_PROCESANDO :
                $res = 'PROCESANDO';
                break;
            case self::ESTADO_ACTIVO :
                $res = 'ACTIVO';
                break;
            case self::ESTADO_INACTIVO :
                $res = 'INACTIVO';
                break;
            case self::ESTADO_CONGELADO :
                $res = 'CONGELADO';
                break;
            case self::ESTADO_CONCLUIDO :
                $res = 'GRADUADO';
                break;
            default:
                $res = 'ACTIVO';
                break;
        }
        return $res;
    }

    /**
     * retorna las inscripcines que estan activas o inactivas.
     * @param $inscripciones[] 
     * @return $inscripciones[]
     */
    static public function parseInscripciones($inscripciones) {
        $res = [];
        foreach ($inscripciones as $key => $inscripcion) {
            if ($inscripcion['estado'] == self::ESTADO_ACTIVO || $inscripcion['estado'] == self::ESTADO_INACTIVO ) {
                array_push($res, $inscripcion);
            }
        }
        return $res;
    }

}
