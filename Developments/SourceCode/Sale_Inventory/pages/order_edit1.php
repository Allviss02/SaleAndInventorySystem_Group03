<?php
include'../includes/connection.php';

			$id = $_POST['id'];
                        $date = $_POST['date'];
                        $name = $_POST['name'];
			$total = $_POST['total'];
                        $approval = $_POST['approval'];
            
		
            $query = "UPDATE OrderMaster SET Approval = '$approval' WHERE OrderMaster_ID = '$id'";
            $result = mysqli_query($conn, $query);

							
?>	
	<script type="text/javascript">
			alert("You've approval Sale order Successfully.");
			window.location = "order_approve.php";
		</script>
<?php

mysqli_close($conn);