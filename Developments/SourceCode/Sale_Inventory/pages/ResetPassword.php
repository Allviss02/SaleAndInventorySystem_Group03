<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<style>
    
#login .container #login-row #login-column #login-box {
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top: 120px;
  max-width: 400px;
  height: 400px;
  border: 1px solid #9C9C9C;
  background-color: #F4D03F;
  border-radius: 25px;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
  
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
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
        var reID = /^(HR)+[0-9]{2,}$/;
            var sID = dangky.id.value;
              if(!reID.test(sID)){
                  alert("Staff ID is incorrect !"); 
                  dangky.id.value="";
                  dangky.id.focus();
                  return false;
              }
    }
</script>

<body style="background-image: url('../img/Rung Den - Duc.jpg'); background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">
    <div id="login">
        
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" name="dangky" method="post" action="ResetPassword_1.php" onsubmit="return kiemtra();">
                            <h4 class="text-center">Sale and Inventory system</h4>
                            <h5 class="text-center"> Forgot Password </h5>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            <div class="form-group">
                                <label for="id">Staff ID:</label><br>
                                <input type="text" name="id" placeholder="HRxx" id="username" class="form-control" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="email">Staff Email:</label><br>
                                <input type="email" name="email" placeholder="abc@gmail.com" id="username" class="form-control" required>
                            </div>
                            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            <div class="form-group"> 
                                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit" >
                            </div>
                           <div class="form-group"> 
                               <a href="login.php"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back to login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
