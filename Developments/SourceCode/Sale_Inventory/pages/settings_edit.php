<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';
$sql = "SELECT Password, Role_ID FROM Staff WHERE Staff_ID = '$session'";
$res = mysqli_query($conn, $sql);
$ro = mysqli_fetch_array($res);

if($ro[1] == 'AD01'){
    include'../includes/sidebar_Admin.php';
}elseif ($ro[1] == 'A01') {
    include'../includes/sidebar_Acc.php';
}elseif ($ro[1] == 'A02') {
    include'../includes/sidebar_Acc.php';
}elseif ($ro[1] == 'L01') {
    include'../includes/sidebar_Logistics.php';
}elseif ($ro[1] == 'L02') {
    include'../includes/sidebar_Logistics.php';
}elseif ($ro[1] == 'S01') {
    include'../includes/sidebar_Sale.php';
}elseif ($ro[1] == 'S02') {
    include'../includes/sidebar_Sale_Manager.php';
}  

        		
                
      ?>

<center>
        <div class="card shadow mb-4 col-xs-6 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Change Password</h4>
            </div>
            <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="settings.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            
            <div class="card-body">
                <form name="frmChange" method="post" onSubmit="return validatePassword()">
                   
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Current Password:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" type="password" name="currentPassword" required>
                    
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 New Password:
                </div>
                <div class="col-sm-9">
                  <input class="form-control"  type="password"  name="newPassword" required>
                  <span id="newPassword"></span>
                </div>
              </div>
                
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Confirm new password:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  type="password"  name="confirmPassword" required>
                   <span id="confirmPassword"></span>
                   
                </div>
              </div>
              
              <hr>
              <button type="submit" name="btnUpdate" class="btn btn-warning btn-block"
                      onclick="return confirm('Are you sure to update Password ?')"><i class="fa fa-edit fa-fw"></i>Update</button>
                
                   
              </form>  
            </div>
          </div>  
</center>
<script>
function validatePassword() {
output = true;
var pass = /^\w{5,}$/;
var newPassword = frmChange.newPassword.value;
var confirmPassword = frmChange.confirmPassword.value;
if(!pass.test(newPassword)){
        frmChange.newPassword.value="";
        frmChange.newPassword.focus();
        document.getElementById("newPassword").innerHTML = "Password can contain atleast 5 characters !"; 
        output = false;
}else if(newPassword != confirmPassword) {
frmChange.newPassword.value="";
frmChange.confirmPassword.value="";
frmChange.newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "New Password and confirm password should be the same";
output = false;
} 	
return output;
}
</script>
<?php
    
        if(isset($_POST["btnUpdate"])){
        $curr = $_POST["currentPassword"];
        $pass = $_POST["newPassword"];
            
            if(strlen($curr) >= 30){
                $current = $curr;
            }else{
                $current = sha1($curr);
            }
            $upass = sha1($pass);
            if ($current == $ro[0]) {
                $qry = "UPDATE Staff SET Password='$upass' WHERE Staff_ID ='$session'";
                $res = mysqli_query($conn, $qry);
?>
    <script type="text/javascript">
			alert("You've Update Password Successfully.");
			window.location = "settings.php";
		</script>
<?php
    } else{
        ?>
                <script type="text/javascript">
			alert("Your current password is incorrect .");
			
		</script>
        <?php
        
        }   
        }
?>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>
