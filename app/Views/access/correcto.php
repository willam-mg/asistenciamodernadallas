<?php
use App\helpers\Params;
use App\Models\Inscripcion;
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <p class="text-uppercase">
                <?=$sucursal?>
            </p>
        </div>
    </div>
   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="content-foto">
                <?php if ( $estudiante['foto'] ) { ?>
                    <img src="<?= Params::path_server.'/uploads/estudiantes/'.$estudiante['foto'] ?>" alt="Foto" width="100%">
                <?php } ?>
            </div>
            <h4>
                <span style="color:#cc3487">
                    Estudiante: 
                </span>
                <?=$estudiante['nombre'].' '.$estudiante['apellido']?>
            </h4>
            <h4>
                <span style="color:#cc3487">
                    <?=$inscripcion['tipo'] == Inscripcion::STATUS_COMPLETO?'Modalidad: ':'Curso: '?>
                </span>
                <?=$plan['nombre']?>
            </h4>
            <h4>
                <span style="color:#cc3487">
                    Horario: 
                </span>
                <?=$planHorario['inicio']. ' - '.$planHorario['fin']?>
            </h4>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <form method="POST" action="/access/index">
                        <input type="text" name="codigo">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?= $this->endSection() ?>