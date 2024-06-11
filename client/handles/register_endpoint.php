<?php

session_start();

require_once('../../includes/config.php');


try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$first_name = $_POST['firstName'];
		$middle_name = $_POST['middleName'];
		$last_name = $_POST['lastName'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$birthday = $_POST['birthday'];

		$stmt = $pdo->prepare('INSERT INTO tbl_Users (username, email, password, first_name, middle_name, last_name, contact, address, birthday) VALUES (:username, :email, :password, :first_name, :middle_name, :last_name, :contact, :address, :birthday);');

		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':first_name', $first_name);
		$stmt->bindParam(':middle_name', $middle_name);
		$stmt->bindParam(':last_name', $last_name);
		$stmt->bindParam(':contact', $contact);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':birthday', $birthday);

		if ($stmt->execute()) {

			echo json_encode(["status" => "success", "message" => 'register successful', "report" => "read"]);

			$_SESSION['user_id'] = $pdo->lastInsertId();

		}
	}


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "read catch reached"]);
}