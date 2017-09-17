<?php
	
	class ConectorBD{
		
		private $conexion;
		
		//Ésta función conecta con el servidor de base de datos
		// la varible $BD debe contener el nombre de la base de datos a conectar
		public function conectar_servidor($BD){
                    
                    $this->conexion= mysqli_connect("127.0.0.1", "root", "", $BD);
                    
                    
                    return $this->conexion;
		}
		
		//Ésta función ejecuta la sentencia SQL
		public function realizar_consulta($consulta, $BD){
                    
                    $this->conectar_servidor($BD);
                    return mysqli_query($this->conexion, $consulta);
		}
		
		
		public function cerrar_conexion(){
                    if($this->conexion){
                        mysqli_close($this->conexion);
                    }
		}
                
                public function revisar_contenido($param) {
                    try {
                        return mysqli_fetch_assoc($param);
                    } catch (mysqli_sql_exception $ex) {
                        return null;
                    }
                    
                }
                
                public function contar_registros($param){
                    try{
                        return mysql_num_rows($param);
                    
                    }  catch (mysqli_sql_exception $ex){
                        return 0;
                    }
                }
	}
?>