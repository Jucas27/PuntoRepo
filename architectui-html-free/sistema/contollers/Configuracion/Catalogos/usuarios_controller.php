<?php
	session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../../../index.php?bitSesion=1');
    }
    require_once("../../../conexion.php");
    $db = new Conexion;
    $db->conectarBD();

    //Llamada al modelo
    require_once("../../../models/Configuracion/Catalogos/usuarios_model.php");
    $usuario=new tCatUsuario($db->conexionBD());
    
    //Llamada a la vista
    if($_REQUEST['accion']=='ver'){
        $arrUsuarios=$usuario->verAllUsuarios();
        require_once("../../../views/Configuracion/Catalogos/usuarios_view.php");
    }

    if($_REQUEST['accion']=='agregar'){
        require_once("../../../views/Configuracion/Catalogos/usuarios_crud_view.php");
    }

    if($_REQUEST['accion']=='guardar'){
        if($_SESSION['usuario']=='admin'){
            // echo "<pre>";
            // var_dump($_REQUEST);
            // echo "</pre>";
            // exit();
        }
        $db->iniciaTransaccion();
        if($_REQUEST['txtNombre'] !=''){
            $usuario->setvarNombre("'".$_REQUEST['txtNombre']."'");
            $usuario->setvarApellidoPaterno("'".$_REQUEST['txtApellidoP']."'");
            $usuario->setvarApellidoMaterno($_REQUEST['txtApellidoM'] != '' ? "'".$_REQUEST['txtApellidoM']."'" : "NULL");
            $usuario->setvarUsuario("'".$_REQUEST['txtUsuario']."'");
            $usuario->settexPassword("'".$_REQUEST['txtUsuario']."'");
            $usuario->setvarEmail("NULL");
            $usuario->setbitActivo($_REQUEST['chkActivo'] != '' ? 1 : 0);
            $usuario->setintPlanPago("NULL");
            $usuario->guardarUsuario();
        }
        $db->commit();

        $arrUsuarios=$usuario->verAllUsuarios();
        $_REQUEST['accion']='ver';
        require_once("../../../views/Configuracion/Catalogos/usuarios_view.php");
    }
    
    if($_REQUEST['accion']=='editar'){
        $arrUsuario=$usuario->verUsuario($_REQUEST['intUsuario']);
        require_once("../../../views/Configuracion/Catalogos/usuarios_crud_view.php");
    }

?>

