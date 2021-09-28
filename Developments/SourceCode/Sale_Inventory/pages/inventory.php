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
               <h4 class="m-2 font-weight-bold text-primary">Inventory&nbsp;<a  href="inv_add.php"  type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th class="col-md-1" >Warehouse ID</th>
                     <th class="col-md-1" >Product ID</th>
                     <th class="col-md-1" >Product Name</th>
                     <th class="col-md-1" >Receipt Date</th>
                     
                     <th class="col-md-1" >Lot Number</th>
                     <th class="col-md-1" >Production date</th>
                     <th class="col-md-1" >Expiration date</th>
                     <th class="col-md-1" >Pending</th>
                     <th class="col-md-1" >Selling</th>
                     <th class="col-md-1" >Stock</th>
                     <th class="col-md-1" >Action</th>
                   </tr>
               </thead>
          <tbody>

<?php    

    $query = 'SELECT w.Warehouse_ID, w.Product_ID, p.Product_Name, DATE_FORMAT(r.Receipt_Date, "%d/%m/%Y %H:%m:%s") AS Date, w.Lot_Number, DATE_FORMAT(w.Production_Date, "%d/%m/%Y") AS Production, DATE_FORMAT(w.Expiration_Date, "%d/%m/%Y") AS Expiration, w.Pending, w.Selling,(w.Receipt_Quantity - w.Pending - w.Selling) AS Stock
            FROM Warehouse w 
            join Receipt r on w.Receipt_ID = r.Receipt_ID 
            join Product p on w.Product_ID = p.Product_ID';
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
                echo '<td>'. $row['Pending'].'</td>';
                echo '<td>'. $row['Selling'].'</td>';
                echo '<td>'. $row['Stock'].'</td>';
                echo '<td align="right">
                    <a type="button" class="btn btn-primary bg-gradient-primary" href="inv_edit.php?action=edit & id='.$row['Warehouse_ID'] . '"><i class="fas fa-fw fa-th-list"></i> Update</a>
                    </td>';
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
