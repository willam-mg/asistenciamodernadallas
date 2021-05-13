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
    <link rel="preload" href="/assets/img/modernadallas-logo-control-de-acceso.png" as="image" media="(max-width: 500px)">

    <!-- <link rel="preload" href="/assets/css/bootstrap.min.css?v=<?=strtotime(date('Y-m-d', strtotime('+1 week')))?>" as="style" onload="null;this.rel='stylesheet'"> -->
    <style>
        .content-foto{
            background-color: transparent;
            background-image: url(/assets/img/sin_foto.svg);
            background-size: 100%;
            background-position:center;
            width:100%;
            min-height:255px;
        }
        .wrapper{
            display:flex;align-items:center;justify-content:left;height:100vh;background:-webkit-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:-o-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:linear-gradient(272deg,rgba(188,0,14,.768627) 0,#000 100%);color:#fff;background-size:100%;background-position:center
        }
        .escondido{
            position:absolute;
            top:-3000px;
            left:-300px;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script src="/assets/js/jquery-3.6.0.slim.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>
        $("#estudiante-codigo").focus();
        $("body").on("keypress", function (e) {
            13 != e.which || e.shiftKey || (e.preventDefault(), $("#w0").submit());
        }),
        $("body").on("click", function (e) {
            $("#estudiante-codigo").focus();
        });
    </script>
</body>
</html>