<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">Configuracion inicial</h1>
    <p  class="text-center">Seleccione la sucursal</p>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right">
            <form method="POST">
                <input type="hidden" name="sucursal" value="quillacollo">
                <button type="submit" class="btn btn-outline-warning btn-lg">Quillacollo</button>
            </form>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
            <form method="POST">
                <input type="hidden" name="sucursal" value="cochabamba">
                <button type="submit" class="btn btn-outline-warning btn-lg">Cochabamba</button>
            </form>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-left">
            <form method="POST">
                <input type="hidden" name="sucursal" value="sacaba">
                <button type="submit" class="btn btn-outline-warning btn-lg">Sacaba</button>
            </form>
        </div>
    </div>
    
<?= $this->endSection() ?>