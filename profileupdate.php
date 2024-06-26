<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

if(!isset($_SESSION['uemail'])) {
    header("location:login.php");
    exit();
}

// Code to update user profile
$msg = "";
if(isset($_POST['update'])) {
    $uid = $_SESSION['uid'];
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $uphone = $_POST['uphone'];
    $upass = $_POST['upass'];
    $uimage = $_FILES['uimage']['name'];
    
    $temp_name = $_FILES['uimage']['tmp_name'];
    if (!empty($uimage)) {
        move_uploaded_file($temp_name, "userimages/$uimage");
    } else {
        // Fetch existing image from the database if new image is not uploaded
        $result = mysqli_query($con, "SELECT uimage FROM user WHERE uid={$uid}");
        $row = mysqli_fetch_assoc($result);
        $uimage = $row['uimage'];
    }

    $sql = "UPDATE user SET uname='{$uname}', uemail='{$uemail}', uphone='{$uphone}', upass='{$upass}', uimage='{$uimage}' WHERE uid={$uid}";
    
    $result = mysqli_query($con, $sql);
    if($result == true) {
        $msg = "Profile Updated Successfully!";
        echo "<script>alert('$msg');</script>";
        echo "<script>window.location.href='profile.php';</script>";
        exit();
    } else {
        $msg = "Failed to Update Profile.";
        echo "<script>alert('$msg');</script>";
        echo "<script>window.location.href='updateprofile.php';</script>";
        exit();
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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- CSS Link -->
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

    <!-- Title -->
    <title>Voyage Lux</title>
</head>

<body>

    <div id="page-wrapper">
        <div class="row">
            <!-- Header start -->
            <?php include("include/header.php");?>
            <!-- Header end -->

            <!-- Update Profile -->
            <div class="full-row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="text-secondary double-down-line text-center">Update Profile</h2>
                        </div>
                    </div>
                    <div class="row p-5 bg-white">
                        <?php
                        if (isset($_GET['msg'])) {
                            echo $_GET['msg'];
                        }
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <?php
                            $uid = $_SESSION['uid'];
                            $query = mysqli_query($con, "SELECT * FROM user WHERE uid='$uid'");
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                            <div class="description">
                                <h5 class="text-secondary">Basic Information</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Username</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="uname" required
                                                    value="<?php echo $row['uname']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Email</label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control" name="uemail" required
                                                    value="<?php echo $row['uemail']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Phone</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="uphone" required
                                                    value="<?php echo $row['uphone']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Password</label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control" name="upass" required
                                                    value="<?php echo $row['upass']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Profile Image</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="uimage" type="file">
                                                <img src="userimages/<?php echo $row['uimage'];?>" alt="uimage"
                                                    height="150" width="150">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Update" class="btn btn-success" name="update"
                                    style="margin-left:200px;">
                            </div>
                            <?php
                            } 
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Update Profile -->

            <!-- Footer start -->
            <?php include("include/footer.php");?>
            <!-- Footer start -->

            <!-- Scroll to top -->
            <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i
                    class="fas fa-angle-up"></i></a>
            <!-- End Scroll To top -->
        </div>
    </div>
    <!-- Wrapper End -->

    <!-- JS Link -->
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
						<!---->