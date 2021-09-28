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
               <h4 class="m-2 font-weight-bold text-primary">Sale Order Master</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th class="col-md-1" >Order Master ID</th>
                     <th class="col-md-1" >Order Date</th>
                     <th class="col-md-1" >Customer Name</th>
                     <th class="col-md-1" >Total Amount</th>
                     <th class="col-md-1" >Approval</th>
                     <th class="col-md-1" >Action</th>
                   </tr>
               </thead>   
          <tbody>

<?php    
    
    $query = "SELECT w.OrderMaster_ID, DATE_FORMAT(OrderMaster_Date, '%d/%m/%Y %H:%m:%s') AS Date,Approval, c.Customer_Name,SUM(p.Quantity*k.Selling_Price) AS total
            FROM OrderMaster w 
            join Customer c on c.Customer_ID = w.Customer_ID 
            join OrderDetail p on p.OrderMaster_ID = w.OrderMaster_ID
            join Product k on k.Product_ID = p.Product_ID
            group by w.OrderMaster_ID limit 10";
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
                          
                echo '<tr>';
                echo '<td>'. $row['OrderMaster_ID'].'</td>';
                echo '<td>'. $row['Date'].'</td>';
                echo '<td>'. $row['Customer_Name'].'</td>';
                echo '<td>'. number_format($row['total']).'</td>';
                echo '<td>'. $row['Approval'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="order_searchfrm_view.php?id='.$row['OrderMaster_ID'].'"><i class="fas fa-fw fa-list-alt"></i>Detail</a>
                          
                        </div> </td>';
                
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
