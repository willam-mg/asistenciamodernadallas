<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">Sucursal <?=$sucursal?></h1>
   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <form method="POST">
                <input type="text" name="codigo">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
    
<?= $this->endSection() ?>