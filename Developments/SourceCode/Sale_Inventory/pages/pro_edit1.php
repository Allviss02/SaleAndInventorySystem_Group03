<?php
include('../includes/connection.php');
            $id = $_POST["id"];
            $packing = $_POST["packing"];
            $supplier = $_POST["supplier"];
            $origin = $_POST["origin"];
            $price = $_POST["price"];
            $query = "UPDATE Product set Packing='$packing',Supplier='$supplier',Origin='$origin',Selling_Price='$price' WHERE Product_ID = '$id'";
            
            $result = mysqli_query($conn, $query);

							
?>	
	<script type="text/javascript">
			alert("You've Update Product Successfully.");
			window.location = "product.php";
		</script>
<?php
mysqli_close($conn);