         
            <table class="table table-bordered" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Product ID</th>
                     <th>Name</th>
                     <th>Supplier</th>
                     <th>Selling Price</th>
                     <th>Quantity</th>
                     <th>Stock</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>
              
<?php       
include'../includes/connection.php';

$q = $_GET['q'];
    $query = "SELECT p.Product_ID, Product_Name, Supplier, Selling_Price, (SUM(w.Receipt_Quantity) - SUM(w.Pending) - SUM(w.Selling)) as Stock
            FROM Product p
            JOIN Warehouse w ON w.Product_ID = p.Product_ID
            WHERE Selling_Price > 0 AND Category = '$q'
            GROUP BY w.Product_ID ";
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<form method="post" action="order_add.php?action=add&code= '.$row['Product_ID'].'">';                 
                echo '<tr>';
                echo '<td>'. $row['Product_ID'].'</td>';
                echo '<td><input name="name" value="'. $row['Product_Name'].'" readonly></td>';
                echo '<td >'. $row['Supplier'].'</td>';
                echo '<td><input name="price" value="'. $row['Selling_Price'].'" readonly></td>';
                echo '<td><input type="number" name="quantity" min="0" max="'.$row['Stock'].'" step="25"></td>';
                echo '<td>'. $row['Stock'].'</td>';
                echo '<td align="right">
                       <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info" value="Add" />
                       </td>';
                echo '</tr> ';
                echo '</form>'; 
                        }
?> 
                                    
                                </tbody>
                            </table>
                        
                    
            
            
 
<?php


mysqli_close($conn);
?>


<!-- HOW TO PRINT YOUR VALUE JUST FOR CHECKINGGGGG
<script language='JavaScript'>
function getwords()
{
textbox = document.getElementById('FromDate');
if (textbox.value != "")
document.write("You entered: " + textbox.value)
else
alert("No word has been entered!")
}
</script>
<input type="button" onclick="getwords()" value="Enter" /> -->