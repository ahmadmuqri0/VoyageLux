<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
if(!isset($_SESSION['uemail']))
{
	header("location:login.php");
}
$error="";
$msg="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user=$_SESSION['uid'];
    $homestay=$_POST['pid'];
    $reservation=$_POST['sid'];
    $amount=$_POST['amount'];

    $sql="insert into payment (amount,uid,pid,sid)
	values('$amount','$user','$homestay','$reservation')";
	$result=mysqli_query($con,$sql);
	if($result)
    {
        $msg="<p class='alert alert-success'>Payment successful</p>";
    }
    else
    {
        $error="<p class='alert alert-warning'>Payment unsuccessful</p>";
    }
    header("Location:reservationfeature.php?msg=$msg");
}
?>