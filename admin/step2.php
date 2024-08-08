<?php
include '../connection.php';

if(!isset($_SESSION['admin'])){
    header("location:Admin-Login.php");
}
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
else{
    header("location:dashboard.php");
}

if($_SESSION['role'] == 'System_admin'){
    header("location:dashboard.php");
}
else{
    $select_user = "SELECT * FROM `users` WHERE `email` = 'carix2024@gmail.com'";
    $run_select_user = mysqli_query($connect , $select_user);
    $user = mysqli_fetch_array($run_select_user);
    $_SESSION['user_id'] = $user['id'];
}



$select_website="SELECT * FROM `website`";
$run_select_website=mysqli_query($connect,$select_website);
$fetch_web=mysqli_fetch_assoc($run_select_website);
$web_name=$fetch_web['name'];
$web_logo=$fetch_web['logo'];
$web_address=$fetch_web['address'];
$web_phone=$fetch_web['phone'];
$web_wh=$fetch_web['working_hours'];
$web_hotline=$fetch_web['hotline'];
$web_mail=$fetch_web['mail'];


$select = "SELECT * FROM `services` WHERE `type` = 'main' ORDER BY `s_id` DESC";
$run_select = mysqli_query($connect , $select);


if(isset($_POST['submit']) || isset($_POST['checkout'])){
    $services = $_POST['main_service'];
    foreach($services as $service){
        $insert =  $insert ="INSERT INTO `carts` VALUES(NULL , $user_id , NULL , $service , NULL , NULL)";
        $run_insert = mysqli_query($connect , $insert);
    }
    if(isset($_POST['submit'])){
        header("location:step3.php");
    }else{
        header("location:checkout.php");
    }
   
}

//logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:Admin-Login.php");
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="content-language" content="en" />
    <meta name="keywords" content="website, blog, foo, bar" />
    <meta name="author" content="" />
    <meta name="publisher" content="" />
    <meta name="copyright" content="" />
    <meta name="description" content="" />
    <meta name="page-topic" content="" />
    <meta name="page-type" content="" />
    <meta name="audience" content="" />
    <meta name="robots" content="index, follow" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <link rel="icon" href="../images/Home/section-1-img (1).png" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="../customer/css/style.css" />
    <link rel="stylesheet" href="../customer/css/steps.css" />
    <title>CariX</title>
</head>

<body>
    <!--!-------------------------------------------- Navbar ---------------------------------------------->
    <nav class="navbar navbar-expand-lg mainBg mt-3 sticky-top">
        <div class="container-fluid text-capitalize">
            <div class="navImage">
            <a href="./dashboard.php"><img src="../images/<?php echo $web_logo ?>" class="img-fluid" alt="Logo"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse centerNav" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Services</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./Add-service.php">Add Services</a></li>
                            <li><a class="dropdown-item" href="./viewservice.php">View Services</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Accessories</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./Add-product.php">Add Accessories</a></li>
                            <li><a class="dropdown-item" href="./viewproduct.php">View Accessories</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Orders</a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./step2.php">Add Orders</a></li>
                            <li><a class="dropdown-item" href="./vieworder.php">View Orders</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Admins</a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="./Admin-Login.html">Admin Login</a></li> -->
                            <li><a class="dropdown-item" href="./Add-admin.php">Add Admins</a></li>
                            <li><a class="dropdown-item" href="./viewadmin.php">View Admins</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Users</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./Edit-User.php">edit Users</a></li>
                            <li><a class="dropdown-item" href="./viewuser.php">View Users</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Vehicles</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./viewcars.php">View Vehicles</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./Add-Brand.php">Add Car Brand</a></li>
                            <li><a class="dropdown-item" href="./viewbrand.php">View Car Brand</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./Add-Model.php">Add Car Model</a></li>
                            <li><a class="dropdown-item" href="./viewmodel.php">View Car Model</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Appointments</a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">Add Appointment</a></li> -->
                            <li><a class="dropdown-item" href="./viewappointment.php">View Appointments</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Reviews</a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">Add Review</a></li> -->
                            <li><a class="dropdown-item" href="./viewreviews.php">View Reviews</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Wallets</a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">Add Wallet</a></li> -->
                            <li><a class="dropdown-item" href="./viewwallet.php">View Wallets</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Areas</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./Add-Area.php">Add Area</a></li>
                            <li><a class="dropdown-item" href="./viewarea.php">View Areas</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="./Website.php">Edit Website</a>
                    </li>
                </ul>
                <!-- <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gas
                                Station</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Add Gas Station</a></li>
                                <li><a class="dropdown-item" href="#">View Gas Station</a></li>
                            </ul>
                        </li>
                    </ul> -->
                <div class="d-flex align-items-center gap-3">
                    <a class="nav-link rightUser px-3" href="./Admin-Login.php?logout"><i class="fa-solid fa-user"></i>&nbsp;Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!--*--------------------------------------------- Step 2 --------------------------------------------->
    <section class="step2 mainBg">
        <div class="container py-5">
            <form class="row justify-content-center" method="POST">
                <div class="col-lg-7">
                    <div class="custom-card">
                        <div class="d-flex align-items-center gap-4">
                            <a href="./step2.php" class="py-2 px-3 text-black"><i class="fa-solid fa-angle-left fa-xl"></i></a>
                            <div class="mainText">
                                <p class="fw-bold text-capitalize">step-2</p>
                                <h4 class="text-capitalize">select a service</h4>
                                <p class="add">You Have to Choose one Main Service to Select any Add-ons if you want</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center gap-4">
                        <?php foreach($run_select as $data){                           
                            ?> 
                            
                            <div class="col-md-5 p-3 border-gray">   
                                <div class="form-check d-flex gap-3 align-items-center w-100 justify-content-between">
                                    <input type="checkbox" value="<?php echo $data['s_id']; ?>" class="form-check-input cursor-pointer" id="<?php echo $data['s_id']; ?>"  name="main_service[]">
                                    <label for="<?php echo $data['s_id']; ?>" class="form-check-label">
                                        <?php echo $data['s_name']; ?></label>
                                    <div class="box">
                                        <a class="button info d-flex justify-content-center border-purple align-items-center rounded-pill"
                                            href=" <?php echo '#popup'.$data['s_id']; ?>"><i class="fa-solid fa-info"></i></a>
                                    </div>
                                    <div id="<?php echo 'popup'.$data['s_id']; ?>" class="overlay">
                                        <div class="popup">
                                            <p class="fw-bold"><?php echo $data['s_name'];?></p>
                                            <span class="fw-bold"> <?php echo $data['s_price'];?> EGP </span>
                                            <hr>
                                            <a class="close" href="#">&times;</a>
                                            <div class="content">
                                                <p class="text-dark-gray fw-bold mb-2"> This service contains </p>
                                                <ul class="list-discs">
                                                    <li><?php echo $data['description'];?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                        } ?>
                        </div> 
                    </div> 
                </div>
                <div class="col-lg-5 d-flex flex-column gap-4 vertical">
                    <div class="custom-card">
                        <p class="fw-bold text-capitalize">selected car</p>
                        <p class="p-3 fs-5 fw-bold carSelected text-white">NONE</p>
                    </div>
                    <div class="custom-card">
                        <div class="d-flex flex-row">
                            <img src="../images/Services/modern-automobile-mechanic-composition.png" alt="service"
                                width="100%">
                            <img src="../images/Services/34a436be-fdc1-4822-9bc5-b512f434a306.png" alt="service"
                                width="100%" class="mechanic">
                        </div>
                        <button class="mt-3 p-3 fs-5 fw-bold carSelected text-white text-center carSelected w-100" type="submit" name="submit">Continue</button>
                        <!-- <div class="or-line"><span class="bg-white p-3">OR</span></div> -->
                        <p class="text-center py-3 m-0 fw-bold line fs-4">OR</p>
                        <button class="mt-3 p-3 fs-5 fw-bold carSelected text-white text-center carSelected w-100" type="submit" name="checkout">Checkout</button>
                    </div>
                </div>
                    </form>
    </section>

    <!--!---------------------------------------------- Footer -------------------------------------------->


    <script src="../customer/js/bootstrap.bundle.js"></script>
</body>

</html>