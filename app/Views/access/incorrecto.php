<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">Codigo incorrecto revise sus datos </h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <form method="POST" action="/access/index"  id="w0">
                <input type="text"  class="escondido" name="codigo" id="estudiante-codigo">
            </form>
        </div>
    </div>
    
<?= $this->endSection() ?>