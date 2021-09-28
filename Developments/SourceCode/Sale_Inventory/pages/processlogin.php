<?php

include_once '../includes/connection.php';


if (isset($_POST["btnlogin"])) {
    $email = trim($_POST["email"]);
    $query = "SELECT * FROM Staff WHERE Staff_Email = '$email'";
    $rs = mysqli_query($conn, $query);
    $count = mysqli_num_rows($rs);
    if($count === 0){
        ?>    <script type="text/javascript">
                              //then it will be redirected to index.php
                              alert(" Your email is not registered. Please contact your Admin.");
                              window.location = "login.php";
                          </script>
                     <?php 
    }else{
  $pass = trim($_POST["password"]);
  if(strlen($pass) >= 30){
      $upass = $pass;
  }else{
      $upass = sha1($pass);
  }
  $query = "SELECT Password FROM Staff WHERE Staff_Email = '$email'";
    $rs = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($rs);
    if($upass !== $row[0]){
        ?>    <script type="text/javascript">
                              //then it will be redirected to index.php
                              alert(" Your password isn't match with your email.");
                              window.location = "login.php";
                          </script>
                     <?php 
    }else{
//create some sql statement             
        $sql = "SELECT Staff_ID,Staff_Name,Staff_Email,Staff_Phone,Password,e.Role_ID,e.Role_Name
        FROM  `Staff` s
        JOIN `Role` e ON s.Role_ID = e.Role_ID
        WHERE  Staff_Email = '$email' AND Password = '$upass'";
        $result = mysqli_query($conn, $sql);

        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                while($found_user  = mysqli_fetch_array($result)){
                session_start();
                //fill the result to session variable
                $_SESSION["Staff_ID"]  = $found_user["Staff_ID"]; 
                $_SESSION["Staff_Name"] = $found_user["Staff_Name"]; 
                $_SESSION["Staff_Email"]  =  $found_user["Staff_Email"];
                $_SESSION["Staff_Phone"]  =  $found_user["Staff_Phone"];
//                $_SESSION["Department"]  =  $found_user["Department"];
//                $_SESSION["Manager_ID"]  =  $found_user["Manager_ID"];
//                $_SESSION["Password"]  =  $found_user["Password"];
                $_SESSION["Role_ID"]  =  $found_user["Role_ID"];
//                $_SESSION["Role"]  =  $found_user["Role_Name"]; 
                
                $AAA = $_SESSION["Staff_ID"];
            if(!isset($_COOKIE["email_login"])){
                if(isset($_POST["remember"])){
                setcookie ("email_login",$email,time()+ (10 * 24 * 60 * 60));
                setcookie ("pass_login",$upass,time()+ (10 * 24 * 60 * 60));
            }
            }
        //this part is the verification if admin or user ka
        switch($_SESSION["Role_ID"]){
            case 'AD01':
                        ?>    <script type="text/javascript">
                              //then it will be redirected to index.php
                              alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                              window.location = "Admin.php";
                          </script>
                     <?php    
                     break;
            case 'A01': 
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Acc_Exe.php";
                  </script>
                    <?php   
                    break;
            case 'A02': 
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Acc_Exe.php";
                  </script>
                   <?php  
                   break;
            case 'L01': 
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Logistics_Exe.php";
                  </script>
                      <?php  
                      break;
            case 'L02':
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Logistics_Exe.php";
                  </script>
                     <?php  
                     break;
            case 'S01':
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Sale_Exe.php";
                  </script>
                     <?php
                     break;
            case 'S02':
                        ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("<?php echo  $_SESSION['Staff_Name']; ?> Welcome!");
                      window.location = "Sale_Manager.php";
                  </script>
                        <?php 
                        break;
            default:
                    ?>
                <script type="text/javascript">
                alert("Password is wrong with your registered email.");
                window.location = "login.php";
                </script>
              <?php
              break;
        }   
                
//       

         } 
        }
    }   
    }    
} 
 mysqli_close($conn);
