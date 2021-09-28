<?php
include'../includes/connection.php';

              $id = $_POST['id'];
              $date = $_POST['date'];
              $po = $_POST['po'];
 
              $qry = "INSERT INTO Receipt
              VALUES ('$id','$date','$po')";
              $result = mysqli_query($conn, $qry);
              for($a = 0;$a<count($_POST["warehouse"]); $a++){
              $query = "INSERT INTO Warehouse
              VALUES ('".$_POST["warehouse"][$a]."','".$_POST["product"][$a]."','$id','".$_POST["quantity"][$a]."','".$_POST["lot"][$a]."','".$_POST["pro"][$a]."','".$_POST["exp"][$a]."','0','0')";
              $rs = mysqli_query($conn, $query);
              }
        ?>
              <script type="text/javascript">
                  alert("Add new inventory successfully !");
                window.location = "inventory.php";
              </script>
        <?php
  
 
mysqli_close($conn);
