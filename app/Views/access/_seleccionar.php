<?php
use App\helpers\Params;
use App\Models\Inscripcion;
use App\Models\Mensualidad;
?>
<!-- <audio src="/assets/audio/correcto.wav" autoplay="autoplay"></audio> -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-4 text-uppercase text-center">
            <h4>Seleccione su inscripcion</h4>
            <small class="text-warning">Ingrese el numero de su inscripcion y precione enter</small>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="row g-0">
                <div class="col-xs-4 col-sm-5 col-md-5 col-lg-5" style="max-width:40% !important">
                    <div class="content-foto" style="min-height:97px !important">
                        <?php if ( $estudiante['foto'] ) { 
                            $image = Params::path_server.'/uploads/estudiantes/'.$estudiante['foto'];
                        ?>
                            <img src="<?=$image.'?'.time()?>" alt="Foto" width="100%">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-7 col-md-7 col-lg-7" style="max-width:60% !important">
                    <h5 class="card-title">
                        <span style="color:#cc3487">
                            Estudiante: 
                        </span> <br>
                        <span class="text-capitalize">
                            <?=$estudiante['nombre'].' '.$estudiante['apellido']?>
                        </span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <?php foreach ($inscripciones as $key => $inscripcion) { ?>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-4">
                        <table style="border:1px solid white">
                            <tbody>
                                <tr>
                                    <td class="p-2">
                                        <h1>
                                            <?=$key+1?>
                                        </h1>
                                    </td>
                                    <td class="p-2">
                                        <input type="hidden" id="ins-<?=$key+1?>" value="<?=$inscripcion['id']?>">
                                        <?=$inscripcion['tipo'] == 1?'Completo':'Suelto' ?> <br>
                                        <?=$inscripcion['nombre']?> <br>
                                        <?=$inscripcion['turno'].' '.$inscripcion['inicio'].' - '.$inscripcion['fin']?> <br>
                                        <?=Inscripcion::getStrEstado($inscripcion['estado'])?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <!-- <form method="POST" action="/access/seleccionar/<?=$estudiante['id']?>"  id="w0">
                        <input type="text" class="escondido" name="index" id="estudiante-codigo">
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="height:10px">
            <h4 id="showBarCode"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            Hoy: <?=date('d/m/Y')?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
            <p class="text-uppercase">
                <?=$sucursal?>
            </p>
        </div>
    </div>