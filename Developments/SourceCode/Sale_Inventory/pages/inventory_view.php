<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';
$sql = "SELECT Role_ID FROM Staff WHERE Staff_ID = '$session'";
$res = mysqli_query($conn, $sql);
$ro = mysqli_fetch_array($res);

if($ro[0] == 'AD01'){
    include'../includes/sidebar_Admin.php';
}elseif ($ro[0] == 'A01') {
    include'../includes/sidebar_Acc.php';
}elseif ($ro[0] == 'A02') {
    include'../includes/sidebar_Acc.php';
}elseif ($ro[0] == 'L01') {
    include'../includes/sidebar_Logistics.php';
}elseif ($ro[0] == 'L02') {
    include'../includes/sidebar_Logistics.php';
}elseif ($ro[0] == 'S01') {
    include'../includes/sidebar_Sale.php';
}elseif ($ro[0] == 'S02') {
    include'../includes/sidebar_Sale_Manager.php';
}
  
?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Inventory</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Warehouse ID</th>
                     <th>Product ID</th>
                     <th>Product Name</th>
                     <th>Receipt Date</th>
                     <th>Lot Number</th>
                     <th>Production date</th>
                     <th>Expiration date</th>
                     <th>Stock</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT w.Warehouse_ID, w.Product_ID, p.Product_Name, DATE_FORMAT(r.Receipt_Date, "%d/%m/%Y %H:%m:%s") AS Date, w.Lot_Number, DATE_FORMAT(w.Production_Date, "%d/%m/%Y") AS Production, DATE_FORMAT(w.Expiration_Date, "%d/%m/%Y") AS Expiration, (w.Receipt_Quantity - w.Pending - w.Selling) AS Stock 
            FROM Warehouse w 
            JOIN Receipt r ON w.Receipt_ID = r.Receipt_ID 
            JOIN Product p ON w.Product_ID = p.Product_ID
            Where  w.Receipt_Quantity > (w.Pending + w.Selling)';
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['Warehouse_ID'].'</td>';
                echo '<td>'. $row['Product_ID'].'</td>';
                echo '<td>'. $row['Product_Name'].'</td>';
                echo '<td>'. $row['Date'].'</td>';
                echo '<td>'. $row['Lot_Number'].'</td>';
                echo '<td>'. $row['Production'].'</td>';
                echo '<td>'. $row['Expiration'].'</td>';
                echo '<td>'. $row['Stock'].'</td>';
                      
                echo '</tr> ';
                        }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>
