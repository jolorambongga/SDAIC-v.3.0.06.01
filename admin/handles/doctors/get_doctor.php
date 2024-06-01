<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$doctor_id = $_GET['doctor_id'];

	$sql = "SELECT * FROM tbl_Doctors WHERE doctor_id = $doctor_id;";

	$stmt = $pdo->query($sql);

	$doctor = $stmt->fetchAll(PDO::FETCH_ASSOC);

	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "get doctor", "data" => $doctor));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "catch reached"]);
}