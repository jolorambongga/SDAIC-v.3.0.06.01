<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$doctor_id = $_POST['doctor_id'];
	$doctor_name = $_POST['doctor_name'];
	$avail_date = $_POST['avail_date'];
	$avail_time = $_POST['avail_time'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$address = $_POST['address'];

	$sql = "UPDATE tbl_Doctors SET doctor_name = ?, avail_date = ?, avail_time = ?, contact = ?, email = ?, address = ? WHERE doctor_id = ?;";

	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(1, $doctor_name, PDO::PARAM_STR);
	$stmt->bindParam(2, $avail_date, PDO::PARAM_STR);
	$stmt->bindParam(3, $avail_time, PDO::PARAM_STR);
	$stmt->bindParam(4, $contact, PDO::PARAM_STR);
	$stmt->bindParam(5, $email, PDO::PARAM_STR);
	$stmt->bindParam(6, $address, PDO::PARAM_STR);
	$stmt->bindParam(7, $doctor_id, PDO::PARAM_STR);

	$stmt->execute();

	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "update doctor"));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "update catch reached"]);
}