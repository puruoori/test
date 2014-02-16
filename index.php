<?php
	require_once(__DIR__ . '/../framework/framework.php');

	$message = array(
		'status' => 'ok'
	);

	try {
		if (!Utility::isLoggedIn()) throw new Exception('not logged in');

		$id = Parameter::get('id');
		$schedules = Schedules::search($id);

		if ($schedules) {
			$message['schedule'] = $schedules[0];
		}

	} catch (Exception $exception) {
		$message['status'] = 'error';
		$message['message'] = $exception->getMessage();
		
		header("HTTP/1.1 410 Gone");
	}

	header('Content-Type: application/json');
	print(json_encode($message));
?>