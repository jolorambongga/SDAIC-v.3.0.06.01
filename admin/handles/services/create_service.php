<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$service_name = $_POST['service_name'];
	$description = $_POST['description'];
	$duration = $_POST['duration'];
	$cost = $_POST['cost'];
	$doctor_id = $_POST['doctor_id'];

	$postData = array(
        "service_name" => $service_name,
        "description" => $description,
        "duration" => $duration,
        "cost" => $cost,
        "doctor_id" => $doctor_id
    );

	$sql = "INSERT INTO tbl_Services (service_name, description, duration, cost, doctor_id) VALUES (?, ?, ?, ?, ?);";

	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(1, $service_name, PDO::PARAM_STR);
	$stmt->bindParam(2, $description, PDO::PARAM_STR);
	$stmt->bindParam(3, $duration, PDO::PARAM_STR);
	$stmt->bindParam(4, $cost, PDO::PARAM_STR);
	$stmt->bindParam(5, $doctor_id, PDO::PARAM_STR);

	$stmt->execute();


	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "create service", "data" => $postData));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "create catch reached"]);
}