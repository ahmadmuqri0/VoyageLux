<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
if(!isset($_SESSION['uemail']))
{
	header("location:login.php");
}

//// code insert
//// add code
$error="";
$msg="";
if(isset($_POST['add']))
{
	$pax=$_POST['pax'];
    $checkin=$_POST['checkIn'];
    $checkout=$_POST['checkOut'];
    $pid=$_REQUEST['pid'];
    $uid=$_SESSION['uid'];
	
	$sql="insert into reservation (pax,checkin,checkout,pid,uid)
	values('$pax','$checkin','$checkout','$pid','$uid')";
	$result=mysqli_query($con,$sql);
	if($result)
    {
        $msg="<p class='alert alert-success'>Reservation Inserted Successfully</p>";
                
    }
    else
    {
        $error="<p class='alert alert-warning'>Reservation Not Inserted Some Error</p>";
    }
}							
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!--	Css Link
	========================================================-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<!--	Title
	=========================================================-->
<title>Voyage Lux</title>
</head>
<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
--> 


<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("include/header.php");?>
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-secondary double-down-line text-center">Submit Reservation</h2>
                    </div>
                </div>
                <?php
                    $id=$_REQUEST['pid']; 
                    $query=mysqli_query($con,"SELECT * FROM `homestay` WHERE pid='$id'");
                    while($row=mysqli_fetch_array($query))
                    {
                ?>
                <div>
                    <img src="homestay/<?php echo $row['17'];?>" alt="pimage">
                </div>
                <div class="row p-5 bg-white mx-5">
                    <form method="post" enctype="multipart/form-data" class="mx-auto" style="max-width: 50rem;">
                        <div class="description">
                            <h5 class="text-secondary"><?php echo $row['1'];?> </h5><hr>
                            <?php echo $error; ?>
                            <?php echo $msg; ?>
                            <div class="row" style="margin-left: 3rem;">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <label class="col-lg-6 col-form-label">Number Of People</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" name="pax" required placeholder="Enter Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label">Reservation Date</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="checkIn" required placeholder="check in: dd-mm-yyyy">
                                            <br>
                                            <input type="text" class="form-control" name="checkOut" required placeholder="check out: dd-mm-yyyy">
                                        </div>	
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="mt-4 mx-auto" style="max-width: 4rem;">
                            <input type="submit" value="Submit Reservation" class="btn btn-info" name="add">
                        </div>
                    </form>
                </div>    
            </div>
        </div>
	<!--	Submit property   -->
        
        
</div>
</div>
<!--	Footer   start-->
<?php include("include/footer.php");?>
<!--	Footer   start-->

<!-- Scroll to top --> 
<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
<!-- End Scroll To top --> 
<!-- Wrapper End --> 
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<!--	Js Link
============================================================--> 
<script src="js/jquery.min.js"></script> 
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/tinymce/init-tinymce.min.js"></script>
<!--jQuery Layer Slider --> 
<script src="js/greensock.js"></script> 
<script src="js/layerslider.transitions.js"></script> 
<script src="js/layerslider.kreaturamedia.jquery.js"></script> 
<!--jQuery Layer Slider --> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/tmpl.js"></script> 
<script src="js/jquery.dependClass-0.1.js"></script> 
<script src="js/draggable-0.1.js"></script> 
<script src="js/jquery.slider.js"></script> 
<script src="js/wow.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>