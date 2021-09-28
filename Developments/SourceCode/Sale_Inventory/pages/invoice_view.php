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
              <h4 class="m-2 font-weight-bold text-primary">Invoice Detail</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th class="col-md-1" >Order Detail ID</th>
                     <th class="col-md-1" >Customer Name</th>
                     <th class="col-md-1" >Product Name</th>
                     <th class="col-md-1" >Amount</th>
                     <th class="col-md-1" >Delivery Date</th>
                     <th class="col-md-1" >Delivery status</th>
                     <th class="col-md-1" >Invoice Number</th>
                    
                   </tr>
               </thead>   
          <tbody>
<?php
    If($ro[0] == 'S01'){
    $qry = "SELECT OrderMaster_ID, c.Customer_Name
            FROM OrderMaster w
            JOIN Customer c on c.Customer_ID = w.Customer_ID
            WHERE Approval = 'approval' AND c.Staff_ID = '$session'";
    }else{
        $qry = "SELECT OrderMaster_ID, c.Customer_Name
            FROM OrderMaster w
            JOIN Customer c on c.Customer_ID = w.Customer_ID
            WHERE Approval = 'approval'";
    }
    $rs = mysqli_query($conn, $qry);
    while($row = mysqli_fetch_array($rs)){
        $id = $row[0];
        $name = $row[1];
    
            $query = "SELECT OrderDetail_ID, p.Product_Name, (o.Quantity*p.Selling_Price) AS Amount, DATE_FORMAT(Delivery_Date,'%d/%m/%Y') AS Date,Delivery_Status,Invoice
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            WHERE o.OrderMaster_ID = '$id' AND o.Delivery_Status = 'done'";
    
                $result = mysqli_query($conn, $query);        
                    while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>'. $row['OrderDetail_ID'].'</td>';
                echo '<td>'. $name.'</td>';
                echo '<td>'. $row['Product_Name'].'</td>';
                echo '<td>'. number_format($row['Amount']).'</td>';
                echo '<td>'. $row['Date'].'</td>';  
                echo '<td>'. $row['Delivery_Status'].'</td>'; 
                echo '<td>'. $row['Invoice'].'</td>';
                
                echo '</tr>';        
                }
                
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
