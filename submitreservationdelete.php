<?php
include("config.php");
$sid = $_GET['id'];
$sql = "DELETE FROM reservation WHERE sid = {$sid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Reservation Deleted</p>";
	header("Location:reservationfeature.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>Reservation Not Deleted</p>";
	header("Location:reservationfeature.php?msg=$msg");
}
mysqli_close($con);
?>