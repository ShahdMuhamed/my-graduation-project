<?php
include "mailer.php";

//nav and footer
$select_website = "SELECT * FROM `website`";
$run_select_website = mysqli_query($connect, $select_website);
$fetch_web = mysqli_fetch_assoc($run_select_website);
$web_name = $fetch_web['name'];
$web_logo = $fetch_web['logo'];
$web_address = $fetch_web['address'];
$web_phone = $fetch_web['phone'];
$web_wh = $fetch_web['working_hours'];
$web_hotline = $fetch_web['hotline'];
$web_mail = $fetch_web['mail'];

//email
$alert="";
if (isset($_POST['submit'])) {
    $email =$_POST['email'];
    $select="SELECT * FROM `users` WHERE `email`='$email'";
    $run_select = mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run_select);

    if ($rows> 0) {
        $_SESSION['forgot_email']=$email;
        // Generate a verification code
      $verificationCode = strval(rand(100000, 999999));
  
      // Send the verification code to the user's email
      $mail->setFrom('carix2024@gmail.com', 'Carix');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Forgot Password Verification';
      $mail->Body = "Your verification code is: $verificationCode";
      $_SESSION['forgot_code']=$verificationCode;
      
      if($mail->send()){
        header("location:forgototp.php");
      }
      else
      {
        $alert="Mail could not be sent.";
      }
    }
    else {
        $alert= "This Email doesn't Exist, Sign up to make a new Account";
    }
    
}

//logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:./index.php");
}
?>


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
    <link rel="icon" href="./images/Home/section-1-img (1).png" />
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/multisteps.css" />
    <title>CariX</title>
</head>

<body>
    <!--!-------------------------------------------- Navbar ---------------------------------------------->
    <nav class="navbar navbar-expand-lg mainBg mt-3 sticky-top">
        <div class="container-fluid text-capitalize">
            <div class="navImage">
                <img src="../images/<?php echo $web_logo ?>" class="img-fluid" alt="Logo">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse centerNav" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#service">service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#about">about us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            book a service
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./index.php#appointment">Make an Appointment</a></li>
                            <li><a class="dropdown-item" href="./step1.php">make an order</a></li>
                            <!-- <li>
                                <hr class="dropdown-divider">
                            </li> -->
                            <li>
                            <!-- <li><a class="dropdown-item" href="#">Emergency car</a></li> -->
                        </ul>
                    </li>
                    <?php if(isset($_SESSION['user'])){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> my profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="orders.php">orders</a></li>
                            <li><a class="dropdown-item" href="addcar.php">Add car</a></li>
                            <li><a class="dropdown-item" href="savedaddress.php">My Addresses</a></li>
                            <li><a class="dropdown-item" href="editprofile.php">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="changepass.php">Change Password</a></li>
                            <li><a class="dropdown-item" href="htu.php">How To Use</a></li>
                            <li><a class="dropdown-item" href="neargas.php">Nearest Gas Station</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="index.php?logout"><i class="fa-solid fa-right-from-bracket"></i>
                                    logout</a></li>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <?php if(!isset($_SESSION['user'])){ ?>
                        <a class="nav-link rightUser px-3" href="signin.php"><i
                                class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</a>
                                <?php } ?>
                    
                    <a class="nav-link rightNav" href="//api.whatsapp.com/send?phone=2<?php echo $web_phone ?>"><i
                            class="fa-brands fa-whatsapp"></i></a>
                    <!--todo-------------------------------------------- Hotline ----------------------------------------------->
                    <a class="nav-link rightNav" href="#hotline"><img src="../images/services.png" alt="24"
                            width="100%"></a>
                    <div id="hotline" class="popup">
                        <a href="#" class="close">&times;</a>
                        <h3>Call Emergency Car</h3>
                        <p class="fs-5 fw-bold text-center"><i class="fa-solid fa-phone-volume"></i><?php echo $web_hotline ?></p>
                    </div>
                    <a href="#" class="close-popup"></a>
                    <!--todo----------------------------------------- End Hotline ----------------------------------------------->
                    <a class="nav-link navCart rightNav" href="./checkout.php"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
    </nav>




    <!--*------------------------------------------ Multi Steps ------------------------------------------->
    <section class="mainBg py-5">
        <div class="container multiSteps mobile">
            <div class="row align-items-center">
                <div class="col-6">
                    <img src="../images/Forms/reg-img.jpg" alt="Form Image" class="img-fluid">
                </div>
                <div class="col-6 selectForm usualForm pe-2">
                    <form id="form1" method="POST">
                        <h3>Almost there</h3>
                        <p>Please write your email to send a Verification code to you to complete changeing password process </p>
                        <hr>
                        <label for="mobile" class="form-label fw-bold">Email</label>
                        <input type="email" id="phone" placeholder="" class="form-control" name="email" required>
                         <?php if($alert) { ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $alert; ?>
                        </div>
                        <?php } ?>

                        <div class="btn-box">
                            <button type="submit" id="next" class="w-50" name="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--!---------------------------------------------- Footer -------------------------------------------->
    <footer class="mainBg">
        <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100"
            preserveAspectRatio="none">
            <path class="footer-wave-path"
                d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z">
            </path>
        </svg>
        <div class="footer-section">
            <div class="container">
                <div class="footer-cta pt-5 pb-5" id="contact">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="single-cta d-flex justify-content-center">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="cta-text ps-3">
                                    <h4>Find us</h4>
                                    <span><?php echo $web_address ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-cta d-flex justify-content-center">
                                <i class="fas fa-phone"></i>
                                <div class="cta-text ps-3">
                                    <h4>Call us</h4>
                                    <span><?php echo $web_hotline ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mail">
                            <div class="single-cta d-flex justify-content-center">
                                <i class="far fa-envelope-open"></i>
                                <div class="cta-text ps-3">
                                    <h4>Mail us</h4>
                                    <span><?php echo $web_mail ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-content pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-4 px-4 d-flex align-items-center footerCenter">
                            <div class="footer-logo">
                                <a href="index.php"><img src="../images/<?php echo $web_logo ?>" alt="logo" width="100%"></a>
                            </div>
                        </div>
                        <div class="col-lg-4 px-4 footerCenter d-flex flex-column">
                            <div class="footer-widget">
                                <div class="footer-widget-heading">
                                    <h5>Working Hours</h5>
                                </div>
                                <ul class="list-unstyled open-hours list-style-none">
                                    <li class="d-flex gap-4"><span>Mon-Sat</span>
                                        <span><?php echo $web_wh ?></span>
                                    </li>
                                    <li class="d-flex gap-5"><span>Sun </span><span>
                                            Closed</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="footer-widget">
                                <div class="footer-widget-heading">
                                    <h5>We Accept</h5>
                                </div>
                                <div class="footer-visa d-flex flex-row gap-4">
                                    <img src="../images/Home/VISA-logo.png" alt="Visa">
                                    <img src="../images/Home/footermastercard.webp" alt="">
                                </div>

                            </div> -->
                        </div>
                        <div class="col-lg-4 px-4 d-flex align-items-center footerCenter">
                            <div class="footer-text">
                                <p> <span class="fw-bold">CARIX WILL SERVICE YOUR CAR AT YOUR DOORSTEP</span> <br>
                                    We provide full-mobilized car workshop services at the chosen time and location,
                                    with experienced technicians,
                                    high-quality tools, and competitive prices.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="copyright-text text-center">
                    <p class="py-1">Copyright &copy; 2024, All Right Reserved <a href="index.php">CariX</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>