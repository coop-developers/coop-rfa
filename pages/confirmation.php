<?php

$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data
// validate the variables ======================================================
	if (empty($_POST['rfatype']))
		$errors['rfatype'] = 'A RFA must be selected.';
	if (empty($_POST['descrip']))
		$errors['descrip'] = 'Description is required.';
// return a response ===========================================================
	// response if there are errors
	if ( ! empty($errors)) {
		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
		// return all our data to an AJAX call
	} else {
		// if there are no errors
		$data['success'] = true;
		$data['message'] = 'Success!';

		//generate current status
		$current_status = 0;

		//db stuff
		/*$dsn = 'mysql:host=localhost;dbname=test';
		$username = 'test';
		$password = '';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		); 

		try{
			$dbh = new PDO($dsn, $username, $password, $options);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$q = $dbh->prepare("INSERT INTO rfa_queue (user_id, time, type, current_status, description) VALUES (:name, :time, :type, :current_status, :description)");
			$q->bindParam(':user_id', $name);
			$q->bindParam(':time', now());
			$q->bindParam(':type', $_POST['rfatype']);
			$q->bindParam(':current_status', $current_status);
			$q->bindParam(':description', $_POST['descrip']);
			$q->execute();
		}catch(PDOException $e){
			echo $e->getMessage();
		}

		$dbn = null;*/
	}
	echo json_encode($data);