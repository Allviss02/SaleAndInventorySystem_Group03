<?php
include'../includes/connection.php';

			$id = $_POST['id'];
                        $code = $_POST['code'];
                        $qty = $_POST['quantity'];
			$status = $_POST['status'];
                        $ware01 = $_POST['ware01'];
                        $qty_ware01 = $_POST['qty_ware01'];
                        $ware02 = $_POST['ware02'];
                        $qty_ware02 = $_POST['qty_ware02'];
            $qq1 = "SELECT Product_ID FROM Warehouse where Warehouse_ID = '$ware01'";
            $rr1 = mysqli_query($conn, $qq1);
            $rrs1 = mysqli_fetch_array($rr1);
            if($rrs1[0] != $code){
                ?>
                <script type="text/javascript">
			alert("Your 1st warehouse haven't exactly delivery product ID.");
			window.location = "delivery.php";
                        
		</script> 
            <?php
            } 
            $qq2 = "SELECT Product_ID FROM Warehouse where Warehouse_ID = '$ware02'";
            $rr2 = mysqli_query($conn, $qq2);
            $rrs2 = mysqli_fetch_array($rr2);
            if($rrs2[0] != $code){
                ?>
                <script type="text/javascript">
			alert("Your 2nd warehouse haven't exactly delivery product ID.");
			window.location = "delivery.php";
                        
		</script> 
            <?php
            }else{
            if($status == 'prepare'){
                if($qty != ($qty_ware01 + $qty_ware02)){
                ?>
                <script type="text/javascript">
			alert("Your Quantity warehouse is different to quantity order .");
			window.location = "delivery.php";
                        
		</script> 
            <?php
                }else{
                $qry = "SELECT Receipt_Quantity, Pending, Selling FROM Warehouse where Warehouse_ID = '$ware01'";
                $rs = mysqli_query($conn, $qry);
                if($ro = mysqli_fetch_array($rs)){
                $pen1 = $ro[1] + $qty_ware01;
                    if($ro[0] >= ($pen1+$ro[2])){
                    $q = "UPDATE Warehouse SET Pending = '$pen1' WHERE Warehouse_ID = '$ware01'";
                    $r = mysqli_query($conn, $q);
                        
                    }else{
                ?>
                <script type="text/javascript">
			alert("Your Quantity warehouse 01 is greater than stock .");
			window.location = "delivery.php";
                        
		</script> 
            <?php
                    }
                }
                $q = "SELECT Receipt_Quantity, Pending, Selling FROM Warehouse where Warehouse_ID = '$ware02'";
                $r = mysqli_query($conn, $q);
                if($r = mysqli_fetch_array($r)){
                $pen2 = $r[1] + $qty_ware02;
                    if($r[0] >= ($pen2+$r[2])){
                     $q = "UPDATE Warehouse SET Pending = '$pen2' WHERE Warehouse_ID = '$ware02'";
                    $r = mysqli_query($conn, $q);  
                    $qq = "UPDATE OrderDetail SET Ware01 = '$ware01', Qty_Ware01 ='$qty_ware01',Ware02='$ware02',Qty_Ware02='$qty_ware02' where OrderDetail_ID = '$id'";
                    $rr = mysqli_query($conn, $qq);
                     ?>
        <script type="text/javascript">
			alert("You've update prepare status Successfully.");
			window.location = "delivery.php";
                        
		</script>
<?php
                    }else{
                ?>
                <script type="text/javascript">
			alert("Your Quantity warehouse 02 is greater than stock .");
			window.location = "delivery.php";
                        
		</script> 
            <?php  
                    }
                }
                }
                    }else if($status == 'delivery'){
                $ql = "UPDATE OderDetail SET Delivery_Status = '$status' WHERE OrderDetail_ID = '$id'";
                    $rl = mysqli_query($conn, $ql);
                    ?>
        <script type="text/javascript">
			alert("You've update delivery status Successfully.");
			window.location = "delivery.php";
                        
		</script>
<?php
            }else if($status == 'done' ){
                $qry = "SELECT Receipt_Quantity, Pending, Selling FROM Warehouse where Warehouse_ID = '$ware01'";
                $rs = mysqli_query($conn, $qry);
                if($ro = mysqli_fetch_array($rs)){
                $sell1 = $ro[2] + $qty_ware01;
                $pen1 = $ro[1] - $qty_ware01;
                    if($pen1 >= 0 && $ro[0] >= ($sell1 + $pen1)){
                    $q = "UPDATE Warehouse SET Pending = '$pen1', Selling = '$sell1'  WHERE Warehouse_ID = '$ware01'";
                    $r = mysqli_query($conn, $q);
                    }else{
                ?>
                <script type="text/javascript">
			alert("Your Quantity warehouse 01 is greater than stock .");
			window.location = "delivery.php";
                        
		</script> 
            <?php
                    }
                }
                $q = "SELECT Receipt_Quantity, Pending, Selling FROM Warehouse where Warehouse_ID = '$ware02'";
                $r = mysqli_query($conn, $q);
                if($r = mysqli_fetch_array($r)){
                $sell2 = $r[2] + $qty_ware02;
                $pen2 = $r[1] - $qty_ware02;
                    if($pen2 >= 0 && $r[0] >= ($sell2 + $pen2)){
                    $q = "UPDATE Warehouse SET Pending = '$pen2', Selling = '$sell2'  WHERE Warehouse_ID = '$ware01'";
                    $r = mysqli_query($conn, $q);
                    }else{
                ?>
                <script type="text/javascript">
			alert("Your Quantity warehouse 02 is greater than stock .");
			window.location = "delivery.php";
                        
		</script> 
            <?php
                    }
                }
                ?>
        <script type="text/javascript">
			alert("You've update done status Successfully.");
			window.location = "delivery.php";
                       
		</script>
<?php
            }
            }
mysqli_close($conn);