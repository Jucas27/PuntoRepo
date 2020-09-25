<?php
	// session_start();
    // if(!isset($_SESSION['usuario'])){
    //     header('Location: ../../../index.php?bitSesion=1');
    // }
    $_REQUEST='';
    if($_SESSION['usuario']=='admin'){
        // echo "<pre>";
        // var_dump($_REQUEST);
        // echo "</pre>";
        // exit();
    }
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
            
            <div class="app-main__outer">
                <div class="margin-top-30">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios</h5>
                                <table class="mb-0 table table-bordered" id="tabUsuarios">
                                    <thead>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Usuario</th>
                                        <th style="text-align: center">Contraseña</th>
                                        <th>Activo</th>
                                        <th style="text-align: center">Editar</th>
                                        <th style="text-align: center">Borrar</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach ($arrUsuarios as $value) { 
                                                $i++;
                                        ?>
                                            <tr data-index="<?= $i ?>">
                                                <td><?= $value->intUsuario ?></td>
                                                <td><?= $value->varNombre ?></td>
                                                <td><?= $value->varApellidoPaterno ?></td>
                                                <td><?= $value->varApellidoMaterno ?></td>
                                                <td><?= $value->varUsuario ?></td>
                                                <td style="text-align: center">
                                                    <button class="mr-2 btn btn-info" onclick="resetearPassword(<?= $value->intUsuario ?>)" style="<?= $value->bitActivo == 1 ? '' : 'display: none' ?>" >
                                                        <i class="metismenu-icon pe-7s-key"></i>&nbsp; Restaurar
                                                    </button>
                                                </td>
                                                <td><?= $value->bitActivo == 1 ? 'Activo' : 'Inactivo' ?></td>
                                                <td style="text-align: center">
                                                    <a class="mr-2 btn-transition btn btn-outline-info boton-borrar" style="color #ffffff;" href="../../../contollers/Configuracion/Catalogos/usuarios_controller.php?accion=editar&intUsuario=<?= $value->intUsuario ?>">
                                                        <i class="pe-7s-edit btn-icon-wrapper"> </i>
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger boton-borrar" onclick="validaUsuario(<?= $value->intUsuario ?>, <?= $i ?>)">
                                                        <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>                                
                            </div>                                
                                <div class="col-lg-12" style="text-align: end;">
                                    <a class="mb-2 mr-2 btn btn-success boton-agregar" href="../../../contollers/Configuracion/Catalogos/usuarios_controller.php?accion=agregar">Agregar</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../../assets/scripts/main.js"></script>

    <script>
        function resetearPassword(intUsuario){
            // alert(1)
            var usuario = "&intUsuario=" + intUsuario;
            $.ajax({
                url: 'resetearPasswordUsuario.php',
                type: 'post',
                data: usuario,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        Swal.fire({
                            title: 'Exito!',
                            text: 'La contraseña fue restaurada correctamente',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        })
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se puedo actualiza la contraseña',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })

                    }
                }
            });
        }

        function validaUsuario(intUsuario, indice){
            var usuario = "&intUsuario=" + intUsuario;
            $.ajax({
                url: 'verificarBorrarUsuario.php',
                type: 'post',
                data: usuario,
                async: false,
                success: function(response) {
                    if (response == 0) {                        
                        Swal.fire({
                            title: 'Eliminar Registro',
                            text: "¿Está seguro de borrar el registro? \n Está acción no se puede devolver",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: "Cancelar",
                            confirmButtonText: 'Borrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                borrarUsuario(intUsuario, indice)
                            }
                        })
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se puede eliminar el registro, ya que cuenta con uno o más datos en el sistema',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })
                    }
                }
            });
            
        }

        function borrarUsuario(intUsuario, indice){
            var usuario = "&intUsuario=" + intUsuario;
            $.ajax({
                url: 'BorrarUsuario.php',
                type: 'post',
                data: usuario,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        Swal.fire(
                            'Borrado!',
                            'Registro eliminado.',
                            'success'
                        )
                        $('#tabUsuarios > tbody > tr[data-index="'+indice+'"]').remove();
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se puedo eliminar el registro',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })

                    }
                }
            });
        }

    </script>
</body>

</html>