<?php

	class Conexion extends PDO {
		public $db;

		private $server  = '162.241.60.246';
		private $usuario = 'decomaic_ferreteria';
		private $clave = 'sistemaferreteria'; 
		private $base = 'decomaic_dbFerreteria';

		public function __construct() {
		} 
				
		public function conectarBD(){
			try {
				$this->db = new PDO("mysql:host={$this->server};dbname={$this->base};", "{$this->usuario}", "{$this->clave}");
			} catch (PDOException $e) {
				echo 'Falló la conexión: ' . $e->getMessage();
				die();
			}
		}
		
		public function conexionBD(){
			return $this->db;
		}
		public function desconectarBD(){
			$this->db = null;
		}
		
		public function iniciaTransaccion(){
			$this->db->beginTransaction();
		}

		public function commit(){
			$this->db->commit();
		}

		public function rollBack(){
			$this->db->rollBack();
		}

		public function ultimoId(){
			return $this->db->lastInsertId();
		}
				
		public function selectAllDatos($consulta){
			try {
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SelectSQL = $this->db->prepare($consulta);
				$SelectSQL->execute();
				$row = $SelectSQL->fetchAll(PDO::FETCH_OBJ);
				return $row;
			} catch (PDOException $e) {
				$this->ErrorConsulta($e, $consulta);
			}
		}
		
		public function selectDato($consulta) {
			try {
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SelectSQL = $this->db->prepare($consulta);
				$SelectSQL->execute();
				$row = $SelectSQL->fetch(PDO::FETCH_OBJ);
				return $row;
			} catch (PDOException $e) {
				$this->ErrorConsulta($e, $consulta);
			}
		}

		public function ejecutaConsulta($consulta){
			try{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$ExecuteSQL = $this->db->exec($consulta);
				return $ExecuteSQL;
			} catch (PDOException $e) {
				$this->ErrorConsulta($e, $consulta);
			}
		}

		public function ErrorConsulta($e, $consulta){
			print "¡Error!: " . $e->getMessage() ." Query Ejecutado: ".$consulta."<br/>";	
			
			//if($this->dbh->inTransaction()){
			//    $this->rollBack();
			//}
			try{
				$this->rollBack();
				echo "estaba en transacción";
			}
			catch (PDOException $e) {
			// $this->ErrorConsulta($e, $consulta);
			echo "no estaba en transacción";
			}
		
			die();
		}
	}
?>