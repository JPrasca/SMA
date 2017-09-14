<?php
	
	class ConectorBD{
		
		private $conexion;
		
		//Ésta función conecta con el servidor de base de datos
		// la varible $BD debe contener el nombre de la base de datos a conectar
		private function conectar_servidor($BD){
			
			$this->conexion= mysqli_connect("127.0.0.1", "root", "", $BD);
			//mysql_select_db($BD, $this->conexion);
			
		}
		
		//Ésta función ejecuta la sentencia SQL
		public function realizar_consulta($consulta, $BD){
                    
                    $this->conectar_servidor($BD);
                    return mysqli_query($this->conexion, $consulta);
		}
		
		
		public function cerrar_conexion(){
                    mysqli_close($this->conexion);
		}
                
                public function revisar_contenido($param) {
                    
                    return mysqli_fetch_assoc($param);
                }
	}
?>