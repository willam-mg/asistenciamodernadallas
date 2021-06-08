<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <form method="POST" id="w0">
        <input type="text"  class="escondido" name="codigo" id="estudiante-codigo">
    </form>
    <div id="content">
        <?php require '_seleccionar.php' ?>
    </div>
<?= $this->endSection() ?>
