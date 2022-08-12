<?php

class usuario_model extends Odbc
{

	public function __construct()
	{
	}

	function obtener_usuarios(array $params)
	{
		$condi = "";
		if (!empty($params['identificacion'])) {
			$identificacion = $params['identificacion'];
			$condi .= " AND u.identificacion= '$identificacion' ";
		}
		if (!empty($params['tipo'])) {
			$tipo = $params['tipo'];
			$condi .= " AND u.tipodoc= '$tipo' ";
		}
		if (!empty($params['nombres'])) {
			$nombres = $params['nombres'];
			$condi .= " AND u.nombres= '$nombres' ";
		}
		if (!empty($params['apellidos'])) {
			$apellidos = $params['apellidos'];
			$condi .= " AND u.apellidos= '$apellidos' ";
		}
		if (!empty($params['fecnacimiento'])) {
			$fecnacimiento = $params['fecnacimiento'];
			$condi .= " AND u.fecnacimiento= '$fecnacimiento' ";
		}
		if (!empty($params['genero'])) {
			$genero = $params['genero'];
			$condi .= " AND u.genero= '$genero' ";
		}

		$sql = " SELECT u.consec,u.identificacion,u.nombres,u.apellidos,u.fecnacimiento,u.genero,u.tipodoc,'' AS contactos 
		FROM usuario u 
		WHERE u.estado IN ('A','I') 
		$condi ";
		// IBG\rlog($sql);
		return $sql;
	}

	function obtener_usuario(array $params)
	{
		$consec = $params['consec'];
		$sql = " SELECT u.consec,u.identificacion,u.nombres,u.apellidos,u.fecnacimiento,u.genero,u.tipodoc
		FROM usuario u 
		WHERE u.consec = '$consec' ";
		// IBG\rlog($sql);
		return $sql;
	}


	function consultar_estado(array $params)
	{
		$consec = $params['consec'];
		$sql = " SELECT u.estado
		FROM usuario u 
		WHERE u.consec = '$consec' ";
		// IBG\rlog($sql);
		return $sql;
	}

	public function load_users(array $param)
	{
		$identificacion = $param['identificacion'];
		$nombres = $param['nombres'];
		//  print_r($codigoPro); die();
		$term = isset($param['term']) ? $param['term'] : '';
		$whereordenes = '';
		// print_r($term);die();
		if (empty($term['_type'])) {
			$limit =  'first 1000';
			$whereordenes = " AND oc.numero_comprobante || '' LIKE '%" . $term . "%'
			  OR oc.codsucursal || '' LIKE '%" . $term . "%'
			  OR (UPPER(oc.observaciones) LIKE UPPER('%" . $term . "%')) ";
		} else {
			$limit =  'first 100';
		}

		$sql = "SELECT $limit
		s.identificacion as id,s.nombres as text
		FROM usuario u     
		WHERE u.codestado = 'A' 
			$whereordenes
		ORDER BY 2 ";
		// IBG\rlog($sql);
		return $sql;
	}

	function obtener_contacto(array $params)
	{
		$consec = $params['consec'];
		$sql = " SELECT *
		FROM contactos c 
		WHERE c.consec = '$consec' ";
		// IBG\rlog($sql);
		return $sql;
	}

	//FUNCIONES ORDENADAS ALFABETICAMENTE

}
