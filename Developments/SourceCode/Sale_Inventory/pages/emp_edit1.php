<?php
include'../includes/connection.php';

			$zz = $_POST['id'];
                        $name = $_POST['name'];
                        $email = $_POST['email'];
			$pass = $_POST['pass'];
                        $upass = sha1($pass);
                        $role = $_POST['role'];
                        $working = $_POST['working'];
		
            $query = "UPDATE Staff SET Staff_Name = '$name',Staff_Email = '$email',Password = '$upass', Role_ID = '$role', Working = '$working' WHERE Staff_ID = '$zz'";
            $result = mysqli_query($conn, $query);

							
?>	
	<script type="text/javascript">
			alert("You've Update Staff Successfully.");
			window.location = "employee.php";
		</script>
<?php

mysqli_close($conn);