<?php require_once('../config/instantiated_files.php');

          
     
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



  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
  <!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
  <!-- <link href="https://bootswatch.com/3/flatly/bootstrap.css" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

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
          <span style="font-size:12px">Welcoome <strong><?php echo $fullname; ?></strong></span><br>
          <h2>All Applications</h2>
          <p>View All Applications&nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.php">logout</a></p>
        </div>

        <div class="row">

          <div class="col-lg-12">
                  
                    <div class="row">
                     <div class="col-md-12">
                      <div class="card-body">
                      <div class="table-responsive">
                      <!-- <table class="table table-bordered" id="dataTableServer" width="100%" cellspacing="0"> -->
                      <table id="applications" class="table table-bordered display " width="100%" cellspacing="0">
                      <thead>
                      <tr>
                      <!-- <th>Action</th> -->
                      <th>Fullname</th>
                      <th>Profile Image Path(Front)</th>
                      <th>Profile Image Path(Back)</th>
                      <th>DOB</th>
                      <th>State</th>
                      <th>Address</th>
                      <th>Zip</th>
                      <th>Gender</th>
                      <th>Driver's License</th>
                      <th>Weight</th>
                      <th>Current Job</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>SSN</th>
                      <th>Age</th>
                      <th>City</th>
                      <th>Agree to Terms and Conditions?</th>
                      <th>Credit Score</th>
                      <th>Date Created</th>
                      </tr>
                      </thead>
                      <tfoot>
                      <tr>
                      <!-- <th>Action</th> -->
                      <th>Fullname</th>
                      <th>Profile Image Path(Front)</th>
                      <th>Profile Image Path(Back)</th>
                      <th>DOB</th>
                      <th>State</th>
                      <th>Address</th>
                      <th>Zip</th>
                      <th>Gender</th>
                      <th>Driver's License</th>
                      <th>Weight</th>
                      <th>Current Job</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>SSN</th>
                      <th>Age</th>
                      <th>City</th>
                      <th>Agree to Terms and Conditions?</th>
                      <th>Credit Score</th>
                      <th>Date Created</th>
                      </tr>
                      </tfoot>

                      </table>
                      </div>
                      </div>

                  </div>

              </div>


          </div>

          


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

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>



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
              
                var applications = $('#applications').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "ajax": "server_tables/all_applications.php",
                // 'pagingType': 'numbers'
                // "order": [[ 2, "asc" ]],
                // "columnDefs": [
                // { "render": applications,
                // "data": null,         
                // "targets": [0], "width": "9%", "targets": 0 },
                // ]
                } );




       });
  </script>

</body>

</html>