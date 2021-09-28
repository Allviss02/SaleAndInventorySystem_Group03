<?php
include('../includes/connection.php');
            $id = $_POST['id'];
            $a = $_POST['pending'];
            $b = $_POST['selling'];
            $c = $_POST['stock'];
            
            if($c >= 0){
            $query = "UPDATE Warehouse set Pending = '$a', Selling='$b' WHERE Warehouse_ID ='$id'";
            $result = mysqli_query($conn, $query);
?>	
	<script type="text/javascript">
			alert("You've Update Product inventory Successfully.");
			window.location = "inventory.php";
		</script>
<?php
            }else{
                
    ?>
                <script type="text/javascript">
			alert("Your update inventory is FAILED because Stock is negative.");
			window.location = "inventory.php";
		</script>
<?php
            }
mysqli_close($conn);