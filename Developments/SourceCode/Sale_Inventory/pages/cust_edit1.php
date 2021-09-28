<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';

        if(isset($_POST["btnUpdate"])){
			$id = $_POST['id'];
			$name = $_POST['name'];
                        $code = $_POST['code'];
                        $address = $_POST['address'];
                        $email = $_POST['email'];
                        $person = $_POST['person'];
                        $contact = $_POST['contact'];
                        $sale = $_POST['sale'];
	   	
                      
	 	$query = "UPDATE Customer SET Person = '$person', Contact ='$contact', Staff_ID ='$sale' WHERE Customer_ID ='$id'";
		$result = mysqli_query($conn, $query);
        	if(!$result):
                    error_clear_last();
                   die("Nothing to update");
                endif;					
?>	
	<script type="text/javascript">
			alert("You've Update Customer Successfully.");
			window.location = "customer.php";
		</script>
        <?php 
        } 
        mysqli_close($conn);
        ?>