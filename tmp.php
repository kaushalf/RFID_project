<?php
session_start();

if(isset($_SESSION['id'])){


?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RFID</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="tmp.php">MYpayMent</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active b" href="tmp.php">Home</a></li>
          <li><a href="contoller.php"><span>Assign User</span> <i class=""></i></a>
          </li>
          <li><a href="ridemaster.php">Ride Master</a></li>
          <li><a href="usermaster.php">User Master</a></li>
          <li><a href="cardmaster.php">Card Master</a></li>
          <li><a href="newCard.php">New Card</a></li>
          <li><a href="activecard.php">Active Card</a></li>
          <li><a href="transaction_api.php">Transaction</a></li>
          <li><a href="logout.php" class="danger">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <h1>RFID system portal</h1>
      <h2></h2>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-end">
          <div class="col-lg-11">
            <div class="row justify-content-end">

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box py-5">
                  <i class="bi bi-emoji-smile"></i>
                  <?php 
                  include("conn.php");
                  $sql3 = mysqli_query($conn, "SELECT sum(remaining_amount) total_amount FROM transaction");
                  $row3 = $sql3->fetch_assoc();
                  ?>
                  <span data-purecounter-start="0" data-purecounter-end="<?php echo $row3['total_amount'];?>" class="purecounter">0</span>
                  <p>Total Remaining Amount</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box py-5">
                  <i class="bi bi-journal-richtext"></i>
                  <?php 
                  include("conn.php");
                  $sql2 = mysqli_query($conn, "SELECT COUNT(card_id) as total_card FROM card_master");
                  $row2 = $sql2->fetch_assoc();
                  ?>
                  <span data-purecounter-start="0" data-purecounter-end="<?php echo $row2['total_card'];?>" class="purecounter">0</span>
                  <p>Total Card</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                  <i class="bi bi-clock"></i>
                  <?php 
                  include("conn.php");
                  $sql = mysqli_query($conn, "SELECT COUNT(ride_id) as total_ride FROM ride_master");
                  $row = $sql->fetch_assoc();
                  ?>
                  <span data-purecounter-start="0" data-purecounter-end="<?php echo $row['total_ride']-1;?>" class="purecounter">0</span>
                  <p>Total Rides</p>
                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                <div class="count-box pb-5 pt-0 pt-lg-5">
                  <i class="bi bi-award"></i>
                  <?php 
                  // include("conn.php");
                  $sql1 = mysqli_query($conn, "SELECT COUNT(user_id) as total_user FROM user_mater");
                  $row1 = $sql1->fetch_assoc();
                  ?>
                  <span data-purecounter-start="0" data-purecounter-end="<?php echo $row1['total_user'];?>" class="purecounter">0</span>
                  <p>Total Clients</p>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-6 video-box align-self-baseline position-relative">
            <img src="assets/img/rfid.jpeg" class="img-fluid" alt="">
            <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a> -->
          </div>

          <div class="col-lg-6 pt-3 pt-lg-0 content">
            <h3>Hello, Operator use this site for information management.</h3>
            <p class="fst-italic">
             It will provide cashless transaction , with all statistical data of ride which will help the <br> authority for analysis purpose.
            </p>
            <ul>
              <li><i class="bx bx-check-double"></i>Customers can access every eide throgh one single RFID card.</li>
              <li><i class="bx bx-check-double"></i> If balance is exhausted from one's card,one can always recharge thier card.</li>
              <li><i class="bx bx-check-double"></i> Inserte data carefully.</li>
              <li><i class="bx bx-check-double"></i> Manage all the details proper for future.</li>
            </ul>
            <p>
            An RFID payment system project is a project that involves the design and implementation of a payment system that uses RFID technology. 
            RFID (Radio Frequency Identification) is a wireless communication technology that uses radio waves to transfer data between an RFID tag and an RFID reader.
            To build an RFID payment system, you would need to design and develop the hardware and software components that make up the system. 
            This includes the RFID tags, the RFID readers, and the payment processing software that runs on a server.
            </p>
          </div>

        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="text-center">
          <h3>Function</h3>
          <p> ICT Department 
            Marwadi University ,Rajkot
          </p>
          <a class="cta-btn" href="#">Go</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
<!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
<!-- 
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div> -->

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Me</h4>
            <p>
              <strong>Phone:</strong> +91 6353462654<br>
              <strong>Email:</strong> kaushalfaldu1610@gmailcom<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Kaushal Faldu</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Kaushal Faldu</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php
}
else
{
    header("Location: index.php?error=Login again");
}
?>
