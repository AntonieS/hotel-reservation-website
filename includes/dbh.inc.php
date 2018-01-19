<?php

$dbServername = "localhost";
$dbUsername = "root"; //change for online db
$dbPassword = "";
$dbName = "reservations";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(isset($_POST["name"]))
{
	$sql = "SELECT * FROM guests WHERE name = '".$_POST["name"]."'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows(result) > 0)
	{
		echo '<span class="text-danger">Date already taken!</span>';
	}
	else
	{
		echo '<span class="text-success">Date is available</span>';
	}
}