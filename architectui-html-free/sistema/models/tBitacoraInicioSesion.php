<?php
    include("../conexion.php");

    class tBitacoraInicioSesion  extends Conexion{

        public $bintBitacoraInicioSesion;
        public $intUsuario;
        public $datFecha;
        public $varIP;
        public $texNavegador;
        public $bitEntro;
        
        public function __construct($db = null) {
            if($db){
                $this->db = $db;
            }
        }

        public function getbintBitacoraInicioSesion(){
            return $this->bintBitacoraInicioSesion;
        }
        public function setbintBitacoraInicioSesion($bintBitacoraInicioSesion){
            $this->bintBitacoraInicioSesion = $bintBitacoraInicioSesion;
        }
        
        public function getintUsuario(){
            return $this->intUsuario;
        }
        public function setintUsuario($intUsuario){
            $this->intUsuario = $intUsuario;
        }
        
        public function getdatFecha(){
            return $this->datFecha;
        }
        public function setdatFecha($datFecha){
            $this->datFecha = $datFecha;
        }

        public function getvarIP(){
            return $this->varIP;
        }
        public function setvarIP($varIP){
            $this->varIP = $varIP;
        }
        
        public function gettexNavegador(){
            return $this->texNavegador;
        }
        public function settexNavegador($texNavegador){
            $this->texNavegador = $texNavegador;
        }
        
        public function getbitEntro(){
            return $this->bitEntro;
        }
        public function setbitEntro($bitEntro){
            $this->bitEntro = $bitEntro;
        }


        public function verBitacora($bintBitacoraInicioSesion){
            $consulta = "SELECT * FROM tBitacoraInicioSesion WHERE bintBitacoraInicioSesion = ".$bintBitacoraInicioSesion."";
    
            $resultado = $this->selectDato($consulta);
    
            $this->bintBitacoraInicioSesion = $tBitacoraInicioSesion->bintBitacoraInicioSesion;
            $this->intUsuario = $tBitacoraInicioSesion->intUsuario;
            $this->datFecha = $tBitacoraInicioSesion->datFecha;
            $this->varIP = $tBitacoraInicioSesion->varIP;
            $this->texNavegador = $tBitacoraInicioSesion->texNavegador;
            $this->bitEntro = $tBitacoraInicioSesion->bitEntro;

        }

        public function guardarBitacora(){
            $consulta = "INSERT INTO tBitacoraInicioSesion (
                                        intUsuario, 
                                        datFecha, 
                                        varIP, 
                                        texNavegador, 
                                        bitEntro
                                    ) values (
                                        ".$this->intUsuario.",
                                        NOW(),
                                        ".$this->varIP.",
                                        ".$this->texNavegador.",
                                        ".$this->bitEntro."
                                    )";
            // echo "<pre>";
            // var_dump($consulta);
            // echo "</pre>";
            // exit();
            $this->ejecutaConsulta($consulta);
            return $this->ultimoId();
        }
        
        
    }
?>