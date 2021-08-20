<?php
class conexionDB{
	private static $host;
	private $user;
	private $password;
	protected $database;
	private $server;
	private $conn;
	public $mensaje;
	private $resultados;

	public function __construct($arg_tipoConexion_a = array()){
		self::$host = Config::$mvc_bd_hostname;
		$this->user = Config::$mvc_bd_user;
		$this->password = Config::$mvc_bd_pass;
		$this->database = Config::$mvc_bd_name;
		$this->server = Config::$mvc_bd_type;
		$mensaje = '';
		$this->resultados = array();
	}

	private function abrirConexion(){
		if($this->server == 'mysql'){
			try{
				$this->conn = new PDO($this->server.':host='.self::$host.';dbname='.$this->database, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_TO_STRING);
				$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				$this->mensaje = "Conexión establecida con éxito";
			}catch(PDOException $e){
				$this->mensaje = "Conexión fallida <br>".$e;
			}
		}elseif($this->server == 'sqlsrv'){
			try{
				$this->conn = new PDO('sqlsrv:server='.self::$host.' ; Database='.$this->database, $this->user, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_TO_STRING);
				$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
				$this->mensaje = "Conexión establecida con éxito";
			}catch(PDOException $e){
				$this->mensaje = "Conexión fallida <br>".$e;
			}
		}
	}

	public function ejecutarScript($sentencia = '', $params = array()) {
		$sentencia = $this->limpiarConsulta($sentencia);
		 try{
		 	$this->abrirConexion();
			$stmnt = $this->conn->prepare($sentencia);
			if(count($params) > 0){
				foreach ($params as $llave => &$valor) {
					$stmnt->bindParam($llave, $valor);
				}
			}
			 $stmnt->execute();
			 $filas = $stmnt->rowCount();
			if($filas == 0){
				$this->mensaje = "No se encontraron resultados";
				return 1;
			}else {
				$tipo = strtoupper(substr(trim($sentencia), 0, 6));
				if($tipo == 'SELECT')
					$this->resultados = $stmnt->fetchAll();
				$stmnt->closeCursor();
				if($tipo == 'SELECT')
					$this->mensaje = 'Se encontraron '.$filas.' resultados';
				else
					$this->mensaje = 'Operación realizada con éxito';
				return 1;
			}
		 }catch(PDOException $e){
		 	$trace = $e->getTrace();
		 	$this->resultados = array("SQL" => $trace[1]['args'][0]);
			$this->mensaje = 'Error'.$e->getMessage();
			return -1;
		 }
	}

	public function ejecutarStoreProcedure($store = '', $select = '', $params = array()) {
		foreach ($params as $param => $key) {
			$store = str_replace($param, '"'.$key.'"', $store);
		}
		try {
			$this->abrirConexion();
			$this->conn->query($store);
			foreach($this->conn->query($select) as $folio){
				$this->resultados = array_merge($this->resultados, $folio);
			}
			$this->mensaje = 'Operación realizada con éxito';
			return 1;
		}catch(PDOException $e){
			$trace = $e->getTrace();
		 	$this->resultados = array("SQL" => $trace[1]['args'][0]);
			$this->mensaje = 'Error'.$e->getMessage();
			return -1;
		}
	}

	public function getResultados() {
		return $this->resultados;
	}

	private function limpiarConsulta($sentencia) {
		$patternFunciones = '/\{[a-zA-Z_0-9]+\([a-zA-Z_0-9,().=\' ]{0,}\)\}/';
		$parametros = array();
		 preg_match_all($patternFunciones, $sentencia, $matched);
		 $funciones = $matched[0];
		 foreach ($funciones as $key) {
		 	$parametros['param'] = $this->obtenerParametros($key);
		 	$parametros['funcion'] = $this->obtenerNombreFuncion($key, $parametros['param']);
		 	$parametros['key'] = $key;
		 	$parametros['sentencia'] = $sentencia;
		 	if(method_exists($this->$parametros['funcion'])){
		 		$sentencia = $this->$parametros['funcion']($parametros);
		 	}
		 }
		return $sentencia;
	}

	private function obtenerParametros($cadena){
		$patternParametros = '/\(([a-zA-Z()_,.=\'0-9 ]+)\)/';
		preg_match_all($patternParametros, $cadena, $matched);
		return $matched[1][0];
	}

	private function obtenerNombreFuncion($cadena, $parametros){
		$funcion = str_replace($parametros, "", $cadena);
		preg_match_all('/[a-zA-Z_]+/', $funcion, $match);
		return $match[0][0];
	}

	private function limite($params) {
		$sentencia = '';
		$params['sentencia'] = str_replace($params['key'], "", $params['sentencia']);
		if($this->server == 'mysql'){
			$sentencia = ' LIMIT '.$params['param'].' ';
			$params['sentencia'] = $params['sentencia'].$sentencia;
			return $params['sentencia'];
		}elseif($this->server == 'sqlsrv'){
			$sentencia = ' TOP '.$params['param'].' ';
			return str_replace('SELECT', 'SELECT '.$sentencia, $params['sentencia']);
		}
	}

	private function uppercase($params) {
		$sentencia = '';
		if($this->server == 'mysql'){
			$sentencia = 'UCASE('.$params['param'].')';
		}elseif($this->server == 'sqlsrv'){
			$sentencia = 'UPPER('.$params['param'].')';
		}
		return str_replace($params['key'], $sentencia, $params['sentencia']);
	}

	private function lowercase($params) {
		$sentencia = '';
		if($this->server == 'mysql'){
			$sentencia = 'LCASE('.$params['param'].')';
		}elseif($this->server == 'sqlsrv'){
			$sentencia = 'LOWER('.$params['param'].')';
		}
		return str_replace($params['key'], $sentencia, $params['sentencia']);
	}

	private function hoy($params) {
		$sentencia = '';
		if($this->server == 'mysql'){
			$sentencia = 'NOW()';
		}elseif($this->server == 'sqlsrv'){
			$sentencia = 'GETDATE()';
		}
		return str_replace($params['key'], $sentencia, $params['sentencia']);
	}

	private function esnulo($params) {
		$sentencia = '';
		if($this->server == 'mysql'){
			$sentencia = 'IFNULL('.$params['param'].')';
		}elseif($this->server == 'sqlsrv'){
			$sentencia = 'ISNULL('.$params['param'].')';
		}
		$ls_text  = str_replace($params['key'], $sentencia, $params['sentencia']);
		return  $ls_text;
	}

	private function paginar($params) {
		$sentencia = '';
		$la_pag = explode(',',$params['param']);
		if($this->server == 'mysql'){
			$sentencia = " LIMIT ".$la_pag[0].",".$la_pag[1]." ";
		}elseif($this->server == 'sqlsrv'){
		
			$sentencia = " OFFSET ".$la_pag[0]." ROWS
						FETCH NEXT ".$la_pag[1]." ROWS ONLY ";
		}
		return str_replace($params['key'], $sentencia, $params['sentencia']);
	}
	public function __destruct(){
		//unset($this);
	}
}

function f_SQL($ls_script = '', &$datos = array(), &$ls_respuesta = array(), &$ls_mensaje = ''){
	$conexion = new conexionDB();
	$return = $conexion->ejecutarScript($ls_script, $datos);
	$ls_respuesta = $conexion->getResultados();	
	$ls_mensaje = $conexion->mensaje;
	$datos = array();
	return $return;
}

function f_SQL_remoto(&$arg_tipoConexion_a = array(),$arg_script_s = '',  &$arg_datos_a = array(), &$arg_respuesta_a = array(), &$arg_msj_s = ''){
	$ls_script = "SELECT
			nombre,
			server,
			user_id,
			password,
			data_base as 'database',
			provider,
			db_tipo as 'db-tipo'
		FROM
			conexiones
		WHERE
				(id_empresa = :id_empresa)
			AND (tipo_conexion = :tipo_conexion)
		";
	$la_datosSQL = array(
		':id_empresa' => $arg_tipoConexion_a['id_empresa'],
		':tipo_conexion' => $arg_tipoConexion_a['tipo_conexion']
	);
	if(f_SQL($ls_script,$la_datosSQL,$la_conexion,$ls_msj) < 1){
		$arg_msj_s = $ls_msj;
		return -1;
	}
	if(count($la_conexion) < 1){
		$arg_msj_s = 'No tiene una conexión predeterminada para este proceso, asigne una en el catálogo de conexiones para poder continuar.';
		return -1;
	}
	if($arg_script_s == ''){
		return 1;
	}
	foreach ($la_conexion[0] as $ls_tag => $ls_valor) {
		$la_conexion[0][$ls_tag] = base64_decode($ls_valor);
	}		
	
	$conexionRemota = new conexionDB($la_conexion[0]);
	$return = $conexionRemota->ejecutarScript($arg_script_s, $arg_datos_a);
	$arg_respuesta_a = $conexionRemota->getResultados();
	$arg_msj_s = $conexionRemota->mensaje;
	$arg_datos_a = array();
	return $return;
}
function f_SQLStore($ls_store = '', $ls_select = '', &$la_datos, &$la_respuesta, &$ls_mensaje) {
	$conexion = new conexionDB();
	$return = $conexion->ejecutarStoreProcedure($ls_store, $ls_select, $la_datos);
	$la_respuesta = $conexion->getResultados();
	$ls_mensaje = $conexion->mensaje;
	$datos = array();
	return $return;
}