<?php
include("config.php");
$pid = $_GET['id'];
$sql = "DELETE FROM homestay WHERE pid = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Homestay Deleted</p>";
	header("Location:homestayfeature.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>Homestay Not Deleted</p>";
	header("Location:homestayfeature.php?msg=$msg");
}
mysqli_close($con);
?>