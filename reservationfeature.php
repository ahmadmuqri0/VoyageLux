<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");						
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
<link rel="stylesheet" href="css/popup.css">

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
        <!--	Header end  -->
        
        <!--	Banner   --->
        <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>User Listed Reservation</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Listed Reservation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
		 
		 
		<!--	Submit property   -->
        <div class="full-row bg-gray">
            <div class="container"><!-- FOR MORE PROJECTS visit: codeastro.com -->
                    <div class="row mb-5">
						<div class="col-lg-12">
							<h2 class="text-secondary double-down-line text-center">User Listed Reservation</h2>
							<?php 
								if(isset($_GET['msg']))	
								echo $_GET['msg'];	
							?>
                        </div>
					</div><!-- FOR MORE PROJECTS visit: codeastro.com -->
					<table class="items-list col-lg-12 table-hover" style="border-collapse:inherit;">
                        <thead>
                             <tr  class="bg-dark">
                                <th class="text-white font-weight-bolder" style="text-align: center;">Homestay</th>
                                <th class="text-white font-weight-bolder" style="text-align: center;">Number Of People</th>
                                <th class="text-white font-weight-bolder" style="text-align: center;">Check In</th>
                                <th class="text-white font-weight-bolder" style="text-align: center;">Check Out</th>
                                <th class="text-white font-weight-bolder" style="text-align: center;">Option</th>
                             </tr>
                        </thead>
                        <tbody>
						<!-- FOR MORE PROJECTS visit: codeastro.com -->
							<?php 
							$uid=$_SESSION['uid'];
							$query=mysqli_query($con,"SELECT reservation.*, homestay.title FROM `reservation`, `homestay` WHERE reservation.uid='$uid' and homestay.pid=reservation.pid");
								while($row=mysqli_fetch_array($query))
								{
							?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row['6'];?></td>
                                <td style="text-align: center;"><?php echo $row['1'];?></td>
                                <td style="text-align: center;"><?php echo $row['2'];?></td>
                                <td style="text-align: center;"><?php echo $row['3'];?></td>
                                <td>
                                    <div style="display: grid; gap: 1rem; grid-template-columns: 1fr 1fr 1fr;">
                                        <a class="btn btn-info" href="submitreservationupdate.php?id=<?php echo $row['0'];?>">Edit</a>
                                        <a class="btn btn-danger" href="submitreservationdelete.php?id=<?php echo $row['0'];?>">Cancel</a>
                                        <button class="btn btn-success" id="payment">Make Payment</button>
                                    </div>
                                </td>
                            </tr>
							<?php } ?>
							<!-- FOR MORE PROJECTS visit: codeastro.com -->
                        </tbody>
                    </table>            
            </div>
        </div>
	<!--	Submit property   -->
        <!-- The form -->
        <?php 
            $uid=$_SESSION['uid'];
            $query=mysqli_query($con,"SELECT user.uname, homestay.title, homestay.price, reservation.*  FROM `user`, `homestay`, `reservation` WHERE user.uid='$uid' and reservation.uid='$uid' and homestay.pid=reservation.pid");
            while($row=mysqli_fetch_array($query))
            {
                $check_in_date = new DateTime($row['5']);
                $check_out_date = new DateTime($row['6']);
                $interval = $check_in_date->diff($check_out_date);
                $day_count = $interval->days;
                
        ?>
        <div class="form-popup" id="myForm">
            <form method="post" class="form-container" action="payment.php">
                <h1>Payment</h1>
                <label for="user">Name: <?php echo $row["0"]?></label>

                <br>
                <label for="homestay">Homestay: <?php echo $row["1"]?></label>
                <input type="hidden" value="<?php echo $row["7"]?>" name="pid">

                <br>
                <input type="hidden" value="<?php echo $row["3"]?>" name="sid">

                <label for="pax">Pax: <?php echo $row["4"]?></label>

                <br>
                <label for="checkin">Check In: <?php echo $row["5"]?></label>

                <br>
                <label for="checkout">Check Out: <?php echo $row["6"]?></label>

                <?php $amount = ($row["4"] * 10) + ($row["2"] * $day_count); ?>
                <label for="amount">Amount To Pay: RM <?php echo $amount?>.00</label>
                <input type="hidden" value="<?php echo  $amount?>" name="amount">

                <?php }?>
                <input type="submit" class="btn" name="pay" value="Pay">
            </form>
        </div>
        <!--	Footer   start-->
		<?php include("include/footer.php");?>
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div><!-- FOR MORE PROJECTS visit: codeastro.com -->
<!-- Wrapper End --> 



<!--	Js Link
============================================================--> 
<script src="js/jquery.min.js"></script> 
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
<script src="js/popup.js"></script>
</body>
</html> 