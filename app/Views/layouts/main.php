<!doctype html>
<html>
<head>
    <title>Moderna dallas</title>
    <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .content-foto{
            background-color: transparent;
            background-image: url(/assets/img/sin_foto.jpg);
            background-size: 100%;
            width:100%;
            min-height:300px;
        }
        .wrapper{
            display:flex;align-items:center;justify-content:left;height:100vh;background:-webkit-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:-o-linear-gradient(182deg,rgba(188,0,14,.768627) 0,#000 100%);background:linear-gradient(272deg,rgba(188,0,14,.768627) 0,#000 100%);color:#fff;background-size:100%;background-position:center
        }
    </style>
    <!-- <link rel="stylesheet" href="/assets/css/custom.css"> -->
</head>
<body>
    <?php 
        // $session = \Config\Services::session();
        // echo $session->getFlashdata('message'); 
    ?>
    <div class="wrapper">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script href="/assets/js/bootstrap.bundle.min.js"></script>
    <script href="/assets/js/bootstrap.min.js"></script>
</body>
</html>