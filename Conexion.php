<?php 
	header("Access-Control-Allow-Origin: *");
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="";
		private $bd="Prueba";

		public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}
	}


 ?>