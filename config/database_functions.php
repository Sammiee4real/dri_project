<?php
$table = "";
$app_name = 'DRI PROJECT';
require_once("db_connect.php");
require_once("config.php");
global $dbc;


function get_one_row_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        mysqli_set_charset($dbc,'utf8');
        mysqli_query($dbc, "SET NAMES 'utf8'");
        mysqli_query($dbc, 'SET CHARACTER SET utf8');
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }

function user_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$hashpassword'";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
      $access_status = $row['access_status'];

      if($access_status != 1){
                return json_encode(array( "status"=>101, "msg"=>"Sorry, you currently do not have access. Contact Admin!" ));
      }else{
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username or password!" ));

   }
 

}

function insert_into_db($fullname,$dob,$state,$address,$zip,$gender,$driver_license,$weight,$current_job,$phone,$email,$ssn,$age,$city,$agree_to_tnc,$credit_score,$profile_name,$profile_tmp_name,$profile_size,$profile_type,$profile_name2,$profile_tmp_name2,$profile_size2,$profile_type2){
    global $dbc;

     $profile_front_upload = profile_front_upload($profile_name,$profile_size,$profile_tmp_name,$profile_type);
     $profile_front_upload_dec = json_decode($profile_front_upload,true);

     $profile_back_upload = profile_back_upload($profile_name2,$profile_size2,$profile_tmp_name2,$profile_type2);
     $profile_back_upload_dec = json_decode($profile_back_upload,true);


     $check_exist = check_record_by_one_paramv2('applications_tbl','ssn','ssn',$ssn);
  

     if($profile_front_upload_dec['status'] != '111'){
          return json_encode(["status"=>"102","msg"=>$profile_front_upload_dec['msg']  ]);
     }else if($profile_back_upload_dec['status'] != '111'){
          return json_encode(["status"=>"103","msg"=>$profile_back_upload_dec['msg']  ]);
     }

    else if($check_exist){
        return json_encode(["status"=>"105","msg"=>"This Application Exists Already"]);
    }else{
        $profile_front_path = $profile_front_upload_dec['msg'];
        $profile_back_path = $profile_back_upload_dec['msg'];
        $unique_id = unique_id_generator($ssn);
        $sql_insert = "INSERT INTO `applications_tbl` SET
            `unique_id`='$unique_id',
            `fullname`='$fullname',
            `dob`='$dob',
            `state`='$state',
            `address`='$address',
            `zip`='$zip',
            `gender`='$gender',
            `driver_license`='$driver_license',
            `weight`='$weight',
            `current_job`='$current_job',
            `phone`='$phone',
            `email`='$email',
            `ssn`='$ssn',
            `age`='$age',
            `city`='$city',
            `agree_to_tnc`='$agree_to_tnc',
            `credit_score`='$credit_score',
            `profile_front_path`='$profile_front_path',
            `profile_back_path`='$profile_back_path',
            `date_created`=now()
            ";
        $qry_insert = mysqli_query($dbc,$sql_insert);
        if($qry_insert){
          
          return json_encode(["status"=>"111","msg"=>"Application was recieved..."]);

        }else{
                   return json_encode(["status"=>"109","msg"=>"Something went wrong..Try again"]);

        }
    }
}

   function email_function($email, $subject, $content){
        $headers = "From: A Relief Fund Card Applicant\r\n";
        @$mail = mail($email, $subject, $content, $headers);
        return $mail;
        }

function profile_back_upload($file_name, $size, $tmpName,$type){
    global $dbc;
    $upload_path = "profile_back/".$file_name;
    $file_extensions = ['jpg','jpeg','png','JPG','PNG'];//pdf,PDF
    $file_extension = substr($file_name,strpos($file_name, '.') + 1);
    //$file_extension = strtolower(end(explode('.', $file_name)));
    if(!in_array($file_extension, $file_extensions)){
      return json_encode(["status"=>"0","msg"=>"incorrect_format"]);
    }else{
        //2Mb
        if($size > 300000){
          return json_encode(["status"=>"0","msg"=>"too_big"]);
        }else{
          $upload = move_uploaded_file($tmpName, $upload_path);
          if($upload){
              return json_encode(["status"=>"111","msg"=>$upload_path]);
          }else{
              return json_encode(["status"=>"109","msg"=>"upload failed"]);  
          }
        }

    }
}

function profile_front_upload($file_name, $size, $tmpName,$type){
    global $dbc;
    $upload_path = "profile_front/".$file_name;
    $file_extensions = ['jpg','png','JPG','PNG'];//pdf,PDF
    $file_extension = substr($file_name,strpos($file_name, '.') + 1);
    //$file_extension = strtolower(end(explode('.', $file_name)));
    if(!in_array($file_extension, $file_extensions)){
      return json_encode(["status"=>"0","msg"=>"incorrect_format"]);
    }else{
        //2Mb
        if($size > 300000){
          return json_encode(["status"=>"0","msg"=>"too_big"]);
        }else{
          $upload = move_uploaded_file($tmpName, $upload_path);
          if($upload){
              return json_encode(["status"=>"111","msg"=>$upload_path]);
          }else{
              return json_encode(["status"=>"109","msg"=>"upload failed"]);  
          }
        }

    }
}

function check_record_by_one_paramv2($table,$sql_param,$param,$value){
    global $dbc;
    $sql = "SELECT `$sql_param` FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}  



//BELOW ARE OLD FUNCTIONS
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////





function get_total_rows_users($table){
    global $dbc;
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `access_status`=1 ";
    mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    //$total_pages = ceil($total_rows / $no_per_page);
    return $total_rows;
}



function secure_database($value){
    global $dbc;
    $new_value = mysqli_real_escape_string($dbc,$value);
    return $new_value;
}


function check_record_by_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}  



function unique_id_generator($data){
    $data = secure_database($data);
    $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
    return $newid;
}

function update_profile($uid,$fname,$lname,$email){
     global $dbc;

     if ($fname == "" || $lname == "" ||  $email == "" ||  $uid == "") {

          return json_encode(array( "status"=>103, "msg"=>"Empty field(s) found" ));
     
     }else{

        $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email' WHERE `unique_id`='$uid'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Profile update was successful" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"failure" ));

        }

     }
}



function get_rows_from_one_table($table,$order_option){
         global $dbc;
       
        $sql = "SELECT * FROM `$table` ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
           while($row = mysqli_fetch_array($query)){
             $row_display[] = $row;
           }
                          
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}




function admin_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$hashpassword' AND `role`=1";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
      $access_status = $row['access_status'];

      if($access_status != 1){
                return json_encode(array( "status"=>101, "msg"=>"Sorry, you currently do not have access. Contact Admin!" ));
      }else{
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username and password!" ));

   }
 

}




function get_one_row_from_one_table_by_two_params($table,$param,$value,$param2,$value2,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }


    function get_one_row_from_one_table_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2' AND `$param3`='$value3' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }




function  delete_record($table,$param,$value){
    global $dbc;
    $sql = "DELETE FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc,$sql);
    if($query){
      return true;
    }else{
      return false;
    }
}


function get_visible_rows_from_events_with_pagination($table,$offset,$no_per_page){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `events_tbl` WHERE visibility = 1 ORDER BY date_added DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_visible_rows_from_events_with_limit($table,$limit){
         global $dbc;
        $table = secure_database($table);
       
        $sql = "SELECT * FROM `events_tbl` WHERE visibility = 1 ORDER BY date_added DESC LIMIT $limit";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}



function get_rows_from_one_table_with_pagination($table,$offset,$no_per_page){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` ORDER BY date_added DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function update_by_one_param($table,$param,$value,$condition,$condition_value){
  global $dbc;
  $sql = "UPDATE `$table` SET `$param`='$value' WHERE `$condition`='$condition_value'";
  $qry = mysqli_query($dbc,$sql);
  if($qry){
     return true;
  }else{
      return false;
  }
}