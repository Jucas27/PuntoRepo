<?php
	session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?bitSesion=1');
    }
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    // exit();
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ferreteria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Bootstrap -->
    <link href="libs/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
    <script src="libs/jquery/jquery-3.2.1.min.js"></script>
    <script src="libs/jquery/jquery-3.2.1.js"></script>

    <link href="main.css" rel="stylesheet">
    <!-- iconos -->
    <link rel="stylesheet" href="libs/Icon-font/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="libs/Icon-font/pe-icon-7-stroke/css/helper.css">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
  

        <!-- Header -->
        <?php include('assets/header.php') ?>
        <!-- Fin Header -->
        
            
        <div class="app-main">
                <!-- Aside -->
                <?php include('assets/aside.php') ?>
                <!-- Fin Aside -->
            
            <div class="app-main__outer">
                BODY
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/scripts/main.js"></script>
</body>

</html>