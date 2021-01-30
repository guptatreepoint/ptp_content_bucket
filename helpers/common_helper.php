<?php

require_once '../config/constant.php';


/**
 * function helps to check requested method is correct or not
 * @param  string $method [method type like POST, GET, PUT]
 * @return json or boolean
 */
function allowedRequestMethod($method = 'POST'){

	if($_SERVER['REQUEST_METHOD'] !== $method){
		$response = [
			'message' => 'Only ' . $method . ' requests are allowed.',
			'code' => 400,
			'error' => true
		];
		echo json_encode($response);die();
	}
	return true;
}


/**
 * function helps to send json response data and exit
 * @param  string or array  $message [message]
 * @param  boolean $error   [error or not]
 * @param  integer $code    [success = 200 and so on]
 * @return json
 */
function jsonResponse($message = '', $error = false, $code = 200){
	echo json_encode([
		'message' => $message,
		'code' => $code,
		'error' => $error
	]);
	die();
}