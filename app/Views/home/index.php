<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">Configuracion inicial</h1>
    <p  class="text-center">Seleccione la sucursal</p>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center mt-3">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center mt-3">
            <form method="POST">
                <input type="hidden" name="sucursal" value="quillacollo">
                <button type="submit" class="btn btn-outline-warning btn-lg">Quillacollo</button>
            </form>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center mt-3">
            <form method="POST">
                <input type="hidden" name="sucursal" value="cochabamba">
                <button type="submit" class="btn btn-outline-warning btn-lg">Cochabamba</button>
            </form>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center mt-3">
            <form method="POST">
                <input type="hidden" name="sucursal" value="sacaba">
                <button type="submit" class="btn btn-outline-warning btn-lg">Sacaba</button>
            </form>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center mt-3">
        </div>
    </div>
    
<?= $this->endSection() ?>