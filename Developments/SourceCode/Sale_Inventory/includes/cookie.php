<?php

if(isset($_POST["remember"])){
    include_once 'connection.php';

       $email = $_POST["email"];
       $sql = "Select * from Staff where Staff_Email = '$email'";
       $rs = mysqli_query($conn, $query);
       $count = mysqli_num_rows($rs);
       if($count > 0){
               $pass = $_POST["password"];
               if(strlen($pass)>30){
                   $upass = $pass;
               }else {
                   $upass = sha1($pass);
               }
                   setcookie ("email_login",$email,time()+ (1 * 24 * 60 * 60));
                   setcookie ("pass_login",$upass,time()+ (1 * 24 * 60 * 60));
        } 
        
    
}