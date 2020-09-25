<?php
	session_start();    
    require_once("../../../conexion.php");
    $db = new Conexion;
    $db->conectarBD();

    //Llamada al modelo
    require_once("../../../models/Configuracion/Catalogos/usuarios_model.php");
    $usuario=new tCatUsuario($db->conexionBD());
    $existe=$usuario->verificarUsuario("'".$_REQUEST['txtUsuario']."'");

    echo $existe->exiteUSuario;
?>

