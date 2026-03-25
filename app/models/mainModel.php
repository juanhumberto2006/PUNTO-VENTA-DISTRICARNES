<?php
	
	namespace app\models;
	use \PDO;

	if(file_exists(__DIR__."/../../config/server.php")){
		require_once __DIR__."/../../config/server.php";
	}

	class mainModel{

		private $server=DB_SERVER;
		private $db=DB_NAME;
		private $user=DB_USER;
		private $pass=DB_PASS;
		private $port=DB_PORT;


		/*----------  Funcion conectar a BD  ----------*/
		protected function conectar(){
			$conexion = new PDO("pgsql:host=".$this->server.";port=".$this->port.";dbname=".$this->db,$this->user,$this->pass);
			$conexion->exec("SET CHARACTER SET utf8");
			return $conexion;
		}


		/*----------  Funcion ejecutar consultas  ----------*/
		protected function ejecutarConsulta($consulta){
			$sql=$this->conectar()->prepare($consulta);
			$sql->execute();
			return $sql;
		}


		/*----------  Funcion limpiar cadenas  ----------*/
		public function limpiarCadena($cadena){

			$palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==",";","::"];

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			foreach($palabras as $palabra){
				$cadena=str_ireplace($palabra, "", $cadena);
			}

			return $cadena;
		}


		/*----------  Funcion verificar datos  ----------*/
		public function verificarDatos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/",$cadena)){
				return true;
			}else{
				return false;
			}
		}


		/*----------  Funcion generar codigo aleatorio  ----------*/
		public function generarCodigo($longitud,$id){
			$codigo="";
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

			for($i=0;$i<$longitud;$i++){
				$codigo.=$caracteres[rand(0,strlen($caracteres)-1)];
			}

			$codigo=$id.$codigo;

			return $codigo;
		}


		/*----------  Funcion verificar codigo existente  ----------*/
		public function verificarCodigo($tabla,$codigo){
			$sql=$this->conectar()->prepare("SELECT id FROM $tabla WHERE codigo=:CODIGO");
			$sql->bindParam(":CODIGO",$codigo);
			$sql->execute();

			return $sql->rowCount();
		}


		/*----------  Funcion obtener datos  ----------*/
		public function obtenerDatos($tabla){
			$sql=$this->conectar()->prepare("SELECT * FROM $tabla");
			$sql->execute();
			return $sql->fetchAll();
		}


		/*----------  Funcion datos unicos  ----------*/
		public function datosUnicos($consulta){
			$sql=$this->conectar()->prepare($consulta);
			$sql->execute();
			return $sql->fetch();
		}


		/*----------  Funcion guardar datos  ----------*/
		protected function guardarDatos($tabla,$datos){
			$consulta = implode(", ",array_keys($datos));
			$consultaFill = implode(", :",array_keys($datos));
			
			$sql=$this->conectar()->prepare("INSERT INTO $tabla ($consulta) VALUES (:$consultaFill)");

			foreach($datos as $key => $value){
				$sql->bindParam(":".$key,$value);
			}

			$exec=$sql->execute();

			return $exec;
		}


		/*----------  Funcion actualizar datos  ----------*/
		protected function actualizarDatos($tabla,$datos,$condicion){
			$consulta = implode(", ",array_keys($datos));
			
			$sql=$this->conectar()->prepare("UPDATE $tabla SET $consulta WHERE $condicion");

			foreach($datos as $key => $value){
				$sql->bindParam(":".$key,$value);
			}

			$exec=$sql->execute();

			return $exec;
		}


		/*----------  Funcion eliminar datos  ----------*/
		protected function eliminarDatos($tabla,$campo,$id){
			$sql=$this->conectar()->prepare("DELETE FROM $tabla WHERE $campo=:id");
			$sql->bindParam(":id",$id);
			$sql->execute();

			return $sql;
		}


		/*----------  Funcion paginacion de tablas  ----------*/
		protected function paginacion($pagina,$registros,$url,$botones){
			if($pagina==1){
				$pagina=1;
			}

			$pagina=(int)$pagina;
			$total_registros = (int)$registros;
			$limit = "LIMIT $total_registros";
			
			if($pagina>1){
				$pagina=$pagina;
			}else{
				$pagina=1;
			}
			
			$offset = ($pagina-1) * $total_registros;

			$respuesta = [
				'inicio' => $offset,
				'limit' => $limit
			];

			return $respuesta;
		}


		/*----------  Funcion seleccionar pagina  ----------*/
		public function seleccionarPagina($pagina,$registros){
			$pagina=(int)$pagina;
			
			if($pagina>1){
				$pagina=$pagina;
			}else{
				$pagina=1;
			}
			
			$offset = ($pagina-1) * $registros;
			$limit = "LIMIT $offset,$registros";

			$respuesta = [
				'limit' => $limit,
				'offset' => $offset
			];

			return $respuesta;
		}
	}
