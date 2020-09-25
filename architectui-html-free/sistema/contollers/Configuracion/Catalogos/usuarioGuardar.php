<?php
	session_start();
    require_once("../../../conexion.php");
    $db = new Conexion;
    $db->conectarBD();

    //Llamada al modelo
    require_once("../../../models/Configuracion/Catalogos/usuarios_model.php");
    $usuario=new tCatUsuario($db->conexionBD());
    
    if($_SESSION['usuario']=='admin'){
        // echo "<pre>";
        // var_dump($_REQUEST);
        // echo "</pre>";
        // exit();
    }
    $db->iniciaTransaccion();

    $usuario->setvarNombre("'".$_REQUEST['txtNombre']."'");
    $usuario->setvarApellidoPaterno("'".$_REQUEST['txtApellidoP']."'");
    $usuario->setvarApellidoMaterno($_REQUEST['txtApellidoM'] != '' ? "'".$_REQUEST['txtApellidoM']."'" : "NULL");
    $usuario->setvarUsuario("'".$_REQUEST['txtUsuario']."'");
    $usuario->settexPassword("'".$_REQUEST['txtUsuario']."'");
    $usuario->setvarEmail("NULL");
    $usuario->setbitActivo($_REQUEST['chkActivo']);
    $usuario->setintPlanPago("NULL");

    if($_REQUEST['txtintUsuario'] == ''){
        $usuario->guardarUsuario();
    }else{
        $usuario->setintUsuario($_REQUEST['txtintUsuario']);        
        $usuario->editarUsuario();
    }
    
    $db->commit();
    echo "1";

?>

