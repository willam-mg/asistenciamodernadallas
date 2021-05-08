<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">seleccione la sucursal</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <form method="POST">
                <input type="hidden" name="sucursal" value="quillacollo">
                <button type="submit">Quillacollo</button>
            </form>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <form method="POST">
                <input type="hidden" name="sucursal" value="sacaba">
                <button type="submit">Sacaba</button>
            </form>
        </div>
    </div>
    
<?= $this->endSection() ?>