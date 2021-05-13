<?php
use App\helpers\Params;
use App\Models\Inscripcion;
use App\Models\Mensualidad;
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
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
                    Horario: 
                </span>
                <?=$planHorario['inicio']. ' - '.$planHorario['fin']?>
            </h5>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <form method="POST" action="/access/index"  id="w0">
                        <input type="text" class="escondido" name="codigo" id="estudiante-codigo">
                    </form>
                </div>
            </div>
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
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if ( count($mensualidades) > 0 || count($seminarios) > 0 || count($casilleros) > 0 ){?>					
                        <div class="alert alert-warning text-uppercase text-center" role="alert">
							Por favor pase por secretaria a regular sus cuotas pendientes
						</div>
					<?php } else { ?>
						<div class="alert alert-success text-uppercase text-center" role="alert">
                            <b>Habilitado</b>
						</div>
					<?php } ?>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <p class="text-uppercase">
                <?=$sucursal?>
            </p>
        </div>
    </div>
<?= $this->endSection() ?>
