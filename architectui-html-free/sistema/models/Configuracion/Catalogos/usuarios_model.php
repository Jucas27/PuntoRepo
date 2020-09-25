<?php
    include("../conexion.php");

    class tCatUsuario extends Conexion{

        public $intUsuario;
        public $varNombre;
        public $varApellidoPaterno;
        public $varApellidoMaterno;
        public $varUsuario;
        public $texPassword;
        public $varEmail;
        public $bitActivo;
        public $intPlanPago;
        
        public function __construct($db = null) {
            if($db){
                $this->db = $db;
            }
        }

        public function getintUsuario(){
            return $this->intUsuario;
        }
        public function setintUsuario($intUsuario){
            $this->intUsuario = $intUsuario;
        }
        
        public function getvarNombre(){
            return $this->varNombre;
        }
        public function setvarNombre($varNombre){
            $this->varNombre = $varNombre;
        }
        
        public function getvarApellidoPaterno(){
            return $this->varApellidoPaterno;
        }
        public function setvarApellidoPaterno($varApellidoPaterno){
            $this->varApellidoPaterno = $varApellidoPaterno;
        }

        public function getvarApellidoMaterno(){
            return $this->varApellidoMaterno;
        }
        public function setvarApellidoMaterno($varApellidoMaterno){
            $this->varApellidoMaterno = $varApellidoMaterno;
        }
        
        public function getvarUsuario(){
            return $this->varUsuario;
        }
        public function setvarUsuario($varUsuario){
            $this->varUsuario = $varUsuario;
        }
        
        public function gettexPassword(){
            return $this->texPassword;
        }
        public function settexPassword($texPassword){
            $this->texPassword = $texPassword;
        }
        
        public function getvarEmail(){
            return $this->varEmail;
        }
        public function setvarEmail($varEmail){
            $this->varEmail = $varEmail;
        }
        
        public function getbitActivo(){
            return $this->bitActivo;
        }
        public function setbitActivo($bitActivo){
            $this->bitActivo = $bitActivo;
        }
        
        public function getintPlanPago(){
            return $this->intPlanPago;
        }
        public function setintPlanPago($intPlanPago){
            $this->intPlanPago = $intPlanPago;
        }


        public function verUsuario($intUsuario){
            $consulta = "SELECT * FROM tCatUsuario WHERE intUsuario = ".$intUsuario."";
    
            $resultado = $this->selectDato($consulta);
            return $resultado;
        }

        public function verAllUsuarios(){
            $consulta = "SELECT * FROM tCatUsuario ORDER BY varApellidoPaterno ASC";
    
            $resultado = $this->selectAllDatos($consulta);
            return $resultado;

        }

        public function guardarUsuario(){
            $consulta = "INSERT INTO tCatUsuario (
                                        varNombre, 
                                        varApellidoPaterno, 
                                        varApellidoMaterno, 
                                        varUsuario, 
                                        texPassword,
                                        varEmail,
                                        bitActivo, 
                                        intPlanPago
                                    ) values (
                                        ".$this->varNombre.",
                                        ".$this->varApellidoPaterno.",
                                        ".$this->varApellidoMaterno.",
                                        ".$this->varUsuario.",
                                        MD5(".$this->texPassword."),
                                        ".$this->varEmail.",
                                        ".$this->bitActivo.",
                                        ".$this->intPlanPago."
                                    )";
            $this->ejecutaConsulta($consulta);
            return $this->ultimoId();
        }

        public function editarUsuario(){
            $consulta = "UPDATE tCatUsuario SET
                                        varNombre = ".$this->varNombre.",
                                        varApellidoPaterno = ".$this->varApellidoPaterno.",
                                        varApellidoMaterno = ".$this->varApellidoMaterno.",
                                        bitActivo = ".$this->bitActivo."
                                    WHERE intUsuario = ".$this->intUsuario."";
            $this->ejecutaConsulta($consulta);
        }

        public function verificarUsuario($Usuario){
            $consulta = "SELECT COUNT(intUsuario) exiteUSuario FROM tCatUsuario WHERE varUsuario = ".$Usuario."";
            $resultado = $this->selectDato($consulta);
            return $resultado;
        }

        public function verificarBorrarUsuario($intUsuario){
            $consulta = "SELECT COUNT(intUsuario) exiteUsuario FROM tBitacoraInicioSesion WHERE intUsuario = ".$intUsuario."";
            $resultado = $this->selectDato($consulta);
            return $resultado;
        }

        public function BorrarUsuario($intUsuario){
            $consulta = "DELETE FROM tCatUsuario WHERE intUsuario = ".$intUsuario."";    
            $resultado = $this->ejecutaConsulta($consulta);
            return $resultado;
        }

        public function resetearPassword($intUsuario){
            $consulta = "UPDATE tCatUsuario SET texPassword = MD5(varUsuario) WHERE intUsuario = ".$intUsuario."";    
            $resultado = $this->ejecutaConsulta($consulta);
            return $resultado;
        }
        
        
    }
?>