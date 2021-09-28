
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sales And Inventory</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
 
<script>
    function kiemtra(){
        var reMail = /^\w+[@]\w+[.]\w+([.]\w+)?$/;
              var sMail = dangky.email.value;
              if(!reMail.test(sMail)){
                  alert("Email is incorrect !"); 
                  dangky.email.value="";
                  dangky.email.focus();
                  return false;
              }
        var rePass = /^\w{5,}$/;
            var sPass = dangky.password.value;
              if(!rePass.test(sPass)){
                  alert("Password is atleast 5 characters !"); 
                  dangky.password.value="";
                  dangky.password.focus();
                  return false;
              }
    }
</script>
</head>

<body style="background-image: url('../img/NhaTrang-3.jpg'); background-size: cover;">

  <div class="container mt-5">

    <!-- Outer Row -->
    
        <div  class=" header text-center mb-8">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <!-- Nested Row within Card Body -->
            
<!--              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
              <div  class="container mt--8 pb-5" style="margin-top: 30px;padding: 20px;max-width: 600px;height: 450px;border: 1px solid #9C9C9C;border-radius: 25px;background-color: #45B39D">
                
                  <div class="text-center">
                    <h1 class="h4 mb-8" style="color: white">SIGN IN</h1>
                  </div>
                  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                    <form class="user" style="text-align:left;" action="processlogin.php" method="post" name="dangky" onsubmit="return kiemtra();">
                    
                    <div class="form-group">
                        <label style="text-align:left; color: white">Staff Email:</label>
                        <input class="form-control form-control-user" placeholder="Email: abc@gmail.com" name="email" type="email" 
                               value="<?php if(isset($_COOKIE["email_login"])) { echo $_COOKIE["email_login"]; } ?>" autofocus required>
                    </div>
                    <div class="form-group">
                        <label style="text-align:left; color: white">Password:</label>
                        <input class="form-control form-control-user" placeholder="Password" name="password" type="password" 
                               value="<?php if(isset($_COOKIE["pass_login"])) { echo $_COOKIE["pass_login"]; } ?>"required>
                    </div>
                    <div class="form-group">
                      <div style="align: left;" class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember"
                               <?php if(isset($_COOKIE["email_login"])) { ?> checked <?php } ?>>
                        <label class="custom-control-label" style="color: white" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                        <button class="btn btn-danger btn-block" type="submit" name="btnlogin">Login</button>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                   <div class="text-center">
                       <a  href="ResetPassword.php" style="color: white">Forgot password ?</a>
                  </div> 
                </form>
                
              </div>
            </div>
          </div>
        </div>

      </div>

   

 
  

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--<script src="../vendor/js-cookie/js_cookie.js"></script>-->
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>
<footer style="text-align:center; color: white">
    <h2>Welcome to Sales and Inventory System ! </h2> 
    <span> This is internal web application to manage sales and inventory activities in trade company </span>
    <h4>  License of GROUP 03 </h4>
</footer>
</html>









