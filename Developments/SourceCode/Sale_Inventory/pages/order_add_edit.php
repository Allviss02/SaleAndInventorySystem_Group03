
<?php
include'../includes/connection.php';
                  
    $q = $_GET['q'];
    $query = "SELECT p.Product_ID, Product_Name, Supplier, Selling_Price, (SUM(w.Receipt_Quantity) - SUM(w.Pending) - SUM(w.Selling)) as Stock
            FROM Product p
            JOIN Warehouse w ON w.Product_ID = p.Product_ID
            WHERE Selling_Price > 0 AND w.Product_ID = '$q'
            GROUP BY w.Product_ID ";
        $result = mysqli_query($conn, $query);
      
            $row = mysqli_fetch_assoc($result);                                
                
            echo '<td><input type="number" min="0" max="'.$row['Stock'].'" step="25" class="form-control" name="quantity[]" required></td>';
            
?>
    
<?php    
mysqli_close($conn);
?>         
                               

