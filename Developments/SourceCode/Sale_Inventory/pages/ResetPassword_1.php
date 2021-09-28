    <?php

include'../includes/connection.php';
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $email = $_POST['email'];
    
    $sql = "SELECT Staff_Name,Staff_Email, Password FROM Staff WHERE Staff_ID = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row){
	$name = $row['Staff_Name'];
	$emailCheck=$row['Staff_Email'];
	$password=$row['Password'];
	if($email==$emailCheck) {
		$to = $email;
                $subject = "Your Password to login Sale and Inventory system";
                $txt = "Dear $name,\n Thanks for your using our Sale and Inventory system.\n Please note your password is : $password";
                $txt .= "\r\n You can use it to login and then change it in your account setting.\n Thank you and best regards.\n";
                $txt .= "Administration";
                $headers = "From: davidnhut2001@gmail.com";
                mail($to,$subject,$txt,$headers);
    ?>    <script type="text/javascript">
                alert("Your password is sending successfully. Please check your email !");
                window.location = "login.php";
                </script>
        <?php
	}
	else{
            ?>    <script type="text/javascript">
                alert("Your Email is not match with Staff ID in Sale and Inventory System !");
                window.location = "ResetPassword.php";
                </script>
        <?php
		
	}
}else{
    ?>    <script type="text/javascript">
                alert("Your Staff ID is unavailable in Sale and Inventory System !");
                window.location = "ResetPassword.php";
                </script>
    <?php
}
}
mysqli_close($conn);
?>
