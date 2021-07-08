<?php     session_start();
          require_once("../config/database_functions.php");

          if(isset($_SESSION['uid'])){
            header('location: home.php');
          }
     
          if(isset($_POST['submit'])){

                $password =  $_POST['password'];
                $email =  $_POST['email'];
                $login = user_login($email,$password);
                $login_dec = json_decode($login,true);
                if($login_dec['status'] != 111){
                  $errormsg = $login_dec['msg'];
                  $msg = '<div class="alert alert-danger">'.$errormsg.'</div><hr>';
                } else{
                   $_SESSION['uid'] = $login_dec['user_id']; 
                   // header('Refresh: 3; url=home.php');
                    $msg = '<div class="alert alert-success">Successfully logged in... You will be redirected shortly</div><hr>';
                }


          }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DIRECT RELIEF INTERNATIONAL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top " style="background: black; ">
    <div class="container d-flex align-items-center ">

      <h1 class="logo me-auto"><a href="index.php">DIRECT RELIEF INTERNATIONAL</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
       <!-- <a href="#" class="logo me-auto"><img  src="logo.jpg" alt="" ></a> -->
         <!-- class="logo me-auto" class="img-fluid" -->
     

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->


  <main id="main">
    <!-- ======= About Us Section ======= -->



 
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="margin-top: 150px;">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>ADMIN Login</h2>
          <p>Login and View Applications</p>
          <div class="sent-message2">
                   <?php if(!empty($msg)){  
                        echo $msg;
                   }?>
              </div>
        </div>

        <div class="row">

          <div class="col-lg-2"></div>

          <div class="col-lg-8">
            <form  action="home.php"  method="post" role="form">
               <!-- class="php-email-form" -->
           
              <div class="form-group">
                <label for="name">Email*</label>
                <input type="text" class="form-control" style="width:100%;" required="" name="email" id="email" required>
              </div><hr>
              <div class="form-group">
                <label for="name">Password*</label>
                <input type="password" class="form-control" required="" name="password" id="password" required>
              </div>
              <hr>
              <div class="text-center">
              
                <!-- <button id="submit" name="submit" type="submit">Apply Now</button> -->
                 <input class="btn btn-lg btn-danger" type="submit" id="submit" name="submit" value="Login">

              </div><br><br>
              
            </form>
          </div>

          <div class="col-lg-2 "></div>


        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

<!--     <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> -->

<!--  -->

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; 2021 <strong><span>Direct Relief International</span></strong>. All Rights Reserved.
      </div>
  

    
    
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


  <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script type="text/javascript">
       $(document).ready(function(){
            // $('#submit_application_btn').click(function(){
              $("#application_form").on('submit', function(e) {
                var formData = new FormData(this);
            
              $.ajax({
                url:"ajax/send_application_to_email.php",
                method: "POST",
                data:  formData,
                dataType: JSON,
                contentType: false,
                processData:false,
                // data:$('#application_form').serialize(),
                // beforeSend: function(){
                //      $("#submit_application_btn").attr('disabled', true);
                //       $('.sent-message2').html('<div class="alert alert-primary">Please wait...</div><hr>');
                // },
                success:function(data){
                  console.log(data.output);
                  // $('.sent-message2').html(data);
                  // if( data == 200){             
                  //      $('.sent-message2').html('<div class="alert alert-success">Application received. <br>An account manager has been assigned to you. <br>He will guide you through the process. <br>Kindly send Front and Back picture of your license to your Account Manager.<br>  Best Regards.</div><hr>');
                  //      //alert('Your Application was successfully sent. Thank You');
                  //      // setTimeout( function(){ window.location.href = "custom_send_sms.php"; }, 2000);
                       
                  // }else{
                  //      $('.sent-message2').html('<div class="alert alert-danger">'+data+'</div><hr>');
                  //      //alert('Your Application was NOT successfully sent. Try again: '+data);
                  // } 
                  //$("#submit_application_btn").attr('disabled', false);

                }
                });
            });




       });
  </script>

</body>

</html>