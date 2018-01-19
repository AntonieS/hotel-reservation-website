<?php
	include_once 'dbh.inc.php';

	$name = mysqli_real_escape_string($conn, $_POST['name']); // mysqli_real_escape_string , protects the database from sql injection.
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$checkInDate = mysqli_real_escape_string($conn, $_POST['checkInDate']);
	$checkOutDate = mysqli_real_escape_string($conn, $_POST['checkOutDate']);

	$sql = "INSERT INTO guests (name, surname, phone, email, checkInDate, checkOutDate) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "SQL error";
	} else{
		mysqli_stmt_bind_param($stmt, "ssssss", $name, $surname, $phone, $email, $checkInDate, $checkOutDate);
		mysqli_stmt_execute($stmt);
	}

	header("Location: ../index.php?submit=success");
?>