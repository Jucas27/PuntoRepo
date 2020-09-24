<?php
	session_start();
    include("conexion.php");
    include("funciones/funciones.php");
    include("clases/tBitacoraInicioSesion.php");
    
    $db = new Conexion;
    $db->conectarBD();
    $tBitacoraInicioSesion = new tBitacoraInicioSesion($db->conexionBD());

    $pwd = $_REQUEST['txtPassword'];
    $usu = $_REQUEST['txtUsuario'];
    $consulta = "SELECT 
                    intUsuario,
                    CONCAT(varNombre,
                            ' ',
                            varApellidoPaterno,
                            ' ',
                            IFNULL(varApellidoMaterno, '')) AS nombre,
                    varUsuario
                FROM
                    tCatUsuario
                WHERE
                    varUsuario = '$usu'
                        AND texPassword = md5('$pwd')
                        AND bitActivo = 1;";

    $resultado = $db->selectDato($consulta);

    if($resultado->intUsuario != ''){
        $_SESSION['usuario'] = $resultado->varUsuario;
        $_SESSION['nombre'] = $resultado->nombre;
        $ip = getUserIpAddress();

        $tBitacoraInicioSesion->setintUsuario($resultado->intUsuario);
        $tBitacoraInicioSesion->setvarIP($ip != '' ? "'".$ip."'" : "NULL");
        $tBitacoraInicioSesion->settexNavegador("'".$_SERVER['HTTP_USER_AGENT']."'");
        $tBitacoraInicioSesion->setbitEntro(1);
        // echo "<pre>";
        // var_dump($tBitacoraInicioSesion);
        // echo "</pre>";
        // exit();
        $tBitacoraInicioSesion->guardarBitacora();
        
        header("Location: dashboard.php");
        break;
    }
    $tBitacoraInicioSesion->setintUsuario("NULL");
    $tBitacoraInicioSesion->setvarIP($ip != '' ? "'".$ip."'" : "NULL");
    $tBitacoraInicioSesion->settexNavegador("'".$_SERVER['HTTP_USER_AGENT']."'");
    $tBitacoraInicioSesion->setbitEntro(0);

    $db->desconectarBD();
    header('Location: index.php?bitSesion=2');

  
?>