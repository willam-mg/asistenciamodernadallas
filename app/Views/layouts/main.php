<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Moderna dallas</title>

    <link rel="preload" href="/assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="/assets/js/jquery-3.6.0.slim.min.js" as="script">
    <link rel="preload" href="/assets/js/bootstrap.min.js" as="script">

    <style>
        .content-foto{background-color:transparent;background-image:url(/assets/img/sin_foto.svg);background-size:100%;background-position:center;width:100%;min-height:255px}.wrapper{display:flex;align-items:center;justify-content:left;height:100vh;background:-webkit-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:-o-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:linear-gradient(272deg,rgba(188,0,14,.768627) 0,#000 100%);color:#fff;background-size:100%;background-position:center}.escondido{position:absolute;top:-3000px;left:-300px}.alert-flash{position:fixed!important;width:100%;color:#fff;background-color:#00000029!important}
    </style>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
    <?php if (session()->getFlashdata('message') !== NULL) : ?>
        <div class="alert alert-dismissible fade show text-center p-3 alert-flash"  role="alert">
            <h3>
                <small>
                    <?php echo session()->getFlashdata('message'); ?>
                </small>
            </h3>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>
    <div class="wrapper">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script src="/assets/js/jquery-3.6.0.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>
        $("#estudiante-codigo").focus();
        $("body").on("keypress", function (e) {
            13 != e.which || e.shiftKey || (e.preventDefault(), $("#w0").submit());
        }),
        $("body").on("click", function (e) {
            $("#estudiante-codigo").focus();
        });
        $("#estudiante-codigo").on('input', function() {
            $("#showBarCode").html("");
            $("#showBarCode").append( $(this).val() );
        });
    </script>
</body>
</html>