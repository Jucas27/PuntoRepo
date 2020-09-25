<?php
	session_start();    
    require_once("../../../conexion.php");
    $db = new Conexion;
    $db->conectarBD();

    //Llamada al modelo
    require_once("../../../models/Configuracion/Catalogos/usuarios_model.php");
    $usuario=new tCatUsuario($db->conexionBD());
    $db->iniciaTransaccion();
    $existe=$usuario->verificarBorrarUsuario("'".$_REQUEST['intUsuario']."'");
    $db->commit();

    echo $existe->exiteUsuario;
?>

