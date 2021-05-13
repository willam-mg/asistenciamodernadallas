<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <form method="POST" id="w0">
                <input type="text"  class="escondido" name="codigo" id="estudiante-codigo">
            </form>
            <img src="/assets/img/modernadallas-logo-control-de-acceso.png" alt="moderna dallas" width="500" height="193">
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right text-uppercase">
            <?=$sucursal?>
        </div>
    </div>
    
    
<?= $this->endSection() ?>