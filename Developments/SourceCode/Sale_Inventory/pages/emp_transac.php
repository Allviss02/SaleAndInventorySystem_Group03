<?php
include'../includes/connection.php';

              $id = $_POST['id'];
              $name = $_POST['name'];
              $email = $_POST['email'];
              $phone = $_POST['phone'];
//              $dept = $_POST['department'];
//              $manager = $_POST['manager'];
              $pass = $_POST['password'];
              $upass = sha1($pass);
              $role = $_POST['role'];
              
              $query = "INSERT INTO Staff
              VALUES ('$id','$name','$email','$phone','$upass','$role')";
              $result = mysqli_query($conn, $query);
              
            ?>

              <script type="text/javascript">
                  alert("Add new staff successfully !");
                window.location = "employee.php";
              </script>
<?php 
mysqli_close($conn);
