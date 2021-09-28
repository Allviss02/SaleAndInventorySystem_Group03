<?php
include'../includes/connection.php';

              $id = $_POST['id'];
              $number = $_POST['number'];
            
 
              $qry = "UPDATE OrderDetail SET Invoice = '$number'
              WHERE OrderDetail_ID = '$id'";
              $result = mysqli_query($conn, $qry);
              
        ?>
              <script type="text/javascript">
                  alert("Update invoice number successfully !");
                window.location = "invoice.php";
              </script>
        <?php
  
 
mysqli_close($conn);
