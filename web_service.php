<?php
	/*
    * 	URL donde se encuentra el webservice :
	*
    *   http://localhost/ws/web_service.php?wsdl 
    *
    * Este webservice ayuda a verificar si una orden regitrada en un sistema central existe 
    * en el sistema local de sucursal
    * 
    */

	require_once('./includes/nusoap/lib/nusoap.php');
	include_once('includes/db.php');

	$db = new db();

	$_Url = 'WS_Rappi';

	$server = new soap_server();

	$server->configureWSDL('ws_rappi', $_Url);

	$server->wsdl->schemaTargetNamespace = $_Url;

	$server->wsdl->addComplexType(
		'commandRappi',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'orden_id' 					=> array('name' => 'orden_id', 'type' => 'xsd:string'),
			'order_id' 					=> array('name' => 'order_id', 'type' => 'xsd:string'),
			'num_cia' 					=> array('name' => 'num_cia', 'type' => 'xsd:int'),
			'fecha' 					=> array('name' => 'fecha', 'type' => 'xsd:date'),
			'hora' 						=> array('name' => 'hora', 'type' => 'xsd:time'), 							// Este campo puede ser vacio
			'nombre_cliente' 			=> array('name' => 'nombre_cliente', 'type' => 'xsd:string'),				// Este campo puede ser vacio
			'articulos' 				=> array('name' => 'articulos', 'type' => 'xsd:string'),					// Este campo puede ser vacio
			'instrucciones_especiales' 	=> array('name' => 'instrucciones_especiales', 'type' => 'xsd:string'),		// Este campo puede ser vacio
			'total' 				   	=> array('name' => 'total', 'type' => 'xsd:decimal'), 						// Este campo puede ser vacio
			'tipo' 						=> array('name' => 'tipo', 'type' => 'xsd:string')							// Este campo puede ser vacio
		)
	);

	$server->wsdl->addComplexType(
		'response',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'Info' => array('name' => 'Info', 'type' => 'xsd:string'),
			'Resultado' => array('name' => 'Resultado', 'type' => 'xsd:boolean'),
		)
	);

	$server->register('getExistingRappiCommand', 

		array('name' => 'tns:commandRappi'),

		array('name' => 'tns:response'), 

		$_Url,

		false,

		'rpc',

		'encode',

		'Recibe el ID de la orden, FECHA, HORA y ID_SUCURSAL'
	);

	function getExistingRappiCommand($request){

		if( !isset($request['orden_id']) || $request['orden_id'] == '' ){
			$response=[
				'Info' => '(II) Falta informacion - ID de la orden '.$request['orden_id'],
				'Resultado' => false,
			];
		}else if( !isset($request['order_id']) || $request['order_id'] == '' ){
			$response=[
				'Info' => '(II) Falta informacion - order_id',
				'Resultado' => false,
			];
		}else if( !isset($request['fecha']) || $request['fecha'] == '' ){
			$response=[
				'Info' => '(II) Falta informacion - Fecha de la orden',
				'Resultado' => false,
			];
		}else if( !isset($request['num_cia']) || $request['num_cia'] == '' ){
			$response=[
				'Info' => '(II) Falta informacion - ID_sucursal de la orden',
				'Resultado' => false,
			];
		}else{

			global $db; 	
	
			$getOrder = $db->get($request);
	
			$response = array();
	
			 if($getOrder){
	
				$response=[
					'Info' => '(II) La Orden '.$request['orden_id'].' fue encontrada',
					'Resultado' => true,
				];
	
			 }else{
				$db->add($request);
	
				$response=[
					'Info' => '(II) La Orden '.$request['orden_id'].' no fue encontrada, se registro con exito',
					'Resultado' => true,
				];
			 }
		}

		 return $response;
	}

	$POST_DATA = file_get_contents( 'php://input' );

	if(!isset($POST_DATA) ||  $POST_DATA == '')
	{
		exit();
	}

	$server->service($POST_DATA);

	exit();