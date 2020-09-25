<?php
	// session_start();
    // if(!isset($_SESSION['usuario'])){
    //     header('Location: ../../../index.php?bitSesion=1');
    // }
    // echo "<pre>";
    // var_dump($arrUsuario);
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
    <link href="../../../libs/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../../../libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
    
    <!-- jquery -->
    <script src="../../../libs/jquery/jquery-3.2.1.min.js"></script>
    <script src="../../../libs/jquery/jquery-3.2.1.js"></script>

    <!-- css -->
    <link href="../../../main.css" rel="stylesheet">
    <link href="../../../css/general.css" rel="stylesheet">

    <!-- iconos -->
    <link rel="stylesheet" href="../../../libs/Icon-font/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="../../../libs/Icon-font/pe-icon-7-stroke/css/helper.css">

    <!-- Sweetalert -->
    <script src="../../../libs/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="../../../libs/sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../../libs/sweetalert/dist/sweetalert2.min.css">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
  

        <!-- Header -->
        <?php include('../../../assets/header.php') ?>
        <!-- Fin Header -->
        
            
        <div class="app-main">
                <!-- Aside -->
                <?php include('../../../assets/aside.php') ?>
                <!-- Fin Aside -->
            
            <!-- Body -->
            <div class="app-main__outer">
                <div class="app-main__inner">

                    
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Usuario</h5>
                                        <form class="needs-validation" novalidate>
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="txtNombre">Nombre*</label>
                                                        <input autocomplete="off" name="txtNombre" id="txtNombre" placeholder="Nombre" type="text" class="form-control" tabindex="1" value="<?= $arrUsuario->varNombre?>" required>
                                                        <input type="hidden" id="txtintUsuario" name="txtintUsuario" value="<?= $arrUsuario->intUsuario?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label>Apellido Paterno*</label>
                                                        <input autocomplete="off" name="txtApellidoP" id="txtApellidoP" placeholder="Apellido Paterno" type="text" class="form-control" tabindex="2" value="<?= $arrUsuario->varApellidoPaterno?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label>Apellido Materno</label>
                                                        <input autocomplete="off" name="txtApellidoM" id="txtApellidoM" placeholder="Apellido Materno" type="text" class="form-control" tabindex="3" value="<?= $arrUsuario->varApellidoMaterno?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label>Usuario</label>
                                                        <input autocomplete="off" name="txtUsuario" id="txtUsuario" <?= $arrUsuario->intUsuario != '' ? 'readonly' : '' ?> onblur="verificarUsuario()" placeholder="Usuario" type="text" class="form-control" tabindex="4" value="<?= $arrUsuario->varUsuario?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative form-check">
                                                <input name="chkActivo" id="chkActivo" type="checkbox" class="form-check-input" <?= $arrUsuario->intUsuario == '' ? 'checked' : $arrUsuario->bitActivo == 1 ? 'checked' : '' ?>>
                                                <label class="form-check-label">Activo</label>
                                            </div>                                            
                                            <a class="mt-2 btn btn-primary" href="../../../contollers/Configuracion/Catalogos/usuarios_controller.php?accion=ver" >Catálogo de Usuarios</a>
                                            <button class="mt-2 btn btn-success" onclick="GuardarUsuario()" >Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <!-- Fin Body -->

        </div>
    </div>
    <script type="text/javascript" src="../../../assets/scripts/main.js"></script>
    
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        // if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        // }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function verificarUsuario(){
            var usuario = "&txtUsuario=" + $("#txtUsuario").val();
            $.ajax({
                url: 'verificarUsuario.php',
                type: 'post',
                data: usuario,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        Swal.fire({
                            title: 'Usuario',
                            text: 'El usuario ya existe en el sistema!',
                            icon: 'info',
                            confirmButtonText: 'Aceptar'
                        })

                        $("#txtUsuario").val('')
                        setTimeout(function () {
                            $("#txtUsuario").focus();
                        }, 500);
                    }
                }
            });
        }

        function GuardarUsuario(){
            var txtNombre = $("#txtNombre").val();
            var txtApellidoP = $("#txtApellidoP").val();
            var txtApellidoM = $("#txtApellidoM").val();
            var txtUsuario = $("#txtUsuario").val();
            var txtintUsuario = $("#txtintUsuario").val();
            
            var chkActivo = 0;            
            if( $('#chkActivo').prop('checked') ) {
                chkActivo = 1
            }
            
            var fd = new FormData();
            fd.append('txtNombre', txtNombre);
            fd.append('txtApellidoP', txtApellidoP);
            fd.append('txtApellidoM', txtApellidoM);
            fd.append('txtUsuario', txtUsuario);
            fd.append('txtintUsuario', txtintUsuario);
            fd.append('chkActivo', chkActivo);
        
            $.ajax({
                url: "usuarioGuardar.php",
                type:'POST',
                contentType:false,
                processData:false,
                cache:false,
                async:false,
                data: fd,
                success: function(Response){
                    console.log(Response)
                    if(Response == 1){
                        Swal.fire({
                            title: 'Guardado!',
                            text: 'Los datos se han guadado correctamente',
                            icon: 'success'
                        })

                        setTimeout(function () {
                            $(location).attr('href','../../../contollers/Configuracion/Catalogos/usuarios_controller.php?accion=ver')
                        }, 3000);
                        
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error al guardar los datos',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })
                    }
                }, error: function(err){
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error al guardar los datos',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                }
            })
        
            

        }
    </script>
</body>

</html>