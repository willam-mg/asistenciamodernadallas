<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <form method="POST" id="w0">
                <input type="text"  class="escondido" name="codigo" id="estudiante-codigo">
            </form>
            <img src="/assets/img/modernadallas-logo-control-de-acceso.png" alt="moderna dallas" width="400">
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right text-uppercase">
            <?=$sucursal?>
        </div>
    </div>
    
    
<?= $this->endSection() ?>

<script>
alert('fdfds');
        $("#estudiante-codigo").focus();

    $("body").on("keypress", function (e) {
        13 != e.which || e.shiftKey || (e.preventDefault(), $("#w0").submit());
    }),
    $("body").on("click", function (e) {
        alert('clicked');
        $("#estudiante-codigo").focus();
    });



    // $(document).ready(function () {
    //     setTimeout(() => {
    //         console.log("redirigiendo"), (location.href = "/access");
    //     }, 3e5),
            
            
    // });
</script>