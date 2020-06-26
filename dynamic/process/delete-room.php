<?php
	$id = $_GET['id'];

	include_once 'dbconnect.php';

	$sql = "DELETE FROM room WHERE id=$id";
	mysqli_query($con, $sql);

	header("Location: ../index.php");
?>