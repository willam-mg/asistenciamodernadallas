<?php
use App\Helpers\Params;
use App\Models\Inscripcion;
use App\Models\Mensualidad;
?>
<audio src="/assets/audio/correcto.wav" autoplay="autoplay"></audio>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="content-foto">
            <?php if ( $estudiante['foto'] ) { 
                $image = Params::path_server.'/uploads/estudiantes/'.$estudiante['foto'];
            ?>
                <img src="<?=$image.'?'.time()?>" alt="Foto" width="100%">
            <?php } ?>
        </div>
        <h5>
            <span style="color:#cc3487">
                Estudiante: 
            </span>
            <span class="text-capitalize">
                <?=$estudiante['nombre'].' '.$estudiante['apellido']?>
            </span>
        </h5>
        <h5>
            <span style="color:#cc3487">
                <?=$inscripcion['tipo'] == Inscripcion::STATUS_COMPLETO?'Modalidad: ':'Curso: '?>
            </span>
            <?=$plan['nombre']?>
        </h5>
        <h5>
            <span style="color:#cc3487">
                Estado
            </span>
            <?=Inscripcion::getStrEstado($inscripcion['estado'])?>
        </h5>
        <h5>
            <span style="color:#cc3487">
                Horario: 
            </span>
            <?=$planHorario['inicio']. ' - '.$planHorario['fin']?>
        </h5>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <!-- <form method="POST" action="/access/index"  id="w0">
                    <input type="text" class="escondido" name="codigo" id="estudiante-codigo">
                </form> -->
            </div>
        </div>
        <?php if ( $debe ){ ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <h5>Mensualidades</h5>
                    <?php foreach ($mensualidades as $key => $mensualidad) { ?>
                        <p style="border:1px solid white;padding:10px">
                            <?=Mensualidad::getMes($mensualidad['month']).' '.$mensualidad['year']?> 
                        </p>
                    <?php } ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <h5>Casilleros</h5>
                    <?php foreach ($casilleros as $key => $casillero) { ?>
                        <p style="border:1px solid white;padding:10px">
                            N° <?=$casillero['numero']?> <br>
                            <?=$casillero['saldo'].' Bs.'?> 
                        </p>
                    <?php } ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <h5>Seminarios</h5>
                    <?php foreach ($seminarios as $key => $seminario) { ?>
                        <p style="border:1px solid white;padding:10px">
                            <?=$seminario['nombre']?> <br>
                            <?=$seminario['saldo'].' Bs.'?> 
                        </p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                    
                <?php if ( $debe ){ ?>					
                    <div class="alert alert-warning text-uppercase text-center" role="alert">
                        <h5>
                            Por favor pase por secretaria a regular sus cuotas pendientes
                        </h5>
                        <h5>
                            <small>
                                N° lecturas: 
                                <b>
                                    <?=$numIngresos?>
                                </b>
                            </small>
                        </h5>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-success text-uppercase text-center" role="alert">
                        <h4>Habilitado</h4>
                        <h5>
                            <small>
                                N° lecturas: 
                                <b>
                                    <?=$numIngresos?>
                                </b>
                            </small>
                        </h5>
                    </div>
                <?php } ?>
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
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
        Hoy: <?=date('d/m/Y')?>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
        <p class="text-uppercase">
            <?=$sucursal?>
        </p>
    </div>
</div>