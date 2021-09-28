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
              <h4 class="m-2 font-weight-bold text-primary">Business</h4>
            </div>
    <div class="card-header">
        <form method="post">
        <div style="float:left; width:40%; padding-left: 100px">
            <span >From</span>
            <input type="date" name="from" required> 
        </div>
        <div style="float:left; width:40%; padding-left: 100px">
            <span>To</span>
            <input type="date" name="to" required>
        </div>
            <input name="find" type="submit" value="Find Sale Order">
        </form>
    </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th class="col-md-1" >Order Detail ID</th>
                     <th class="col-md-1" >Customer Name</th>
                     <th class="col-md-1" >Order Date</th>
                     <th class="col-md-1" >Product Name</th>
                     <th class="col-md-1" >Quantity</th>
                     <th class="col-md-1" >Price</th>
                     <th class="col-md-1" >Amount</th>
                     <th class="col-md-1" >Sale</th>
                     
                   </tr>
               </thead>   
          <tbody>
<?php
    if(isset($_POST['find'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
  $query = "SELECT OrderDetail_ID, p.Product_Name, Quantity, p.Selling_Price, (o.Quantity*p.Selling_Price) AS Amount, DATE_FORMAT(Delivery_Date, '%d/%m/%Y') AS Date, DATE_FORMAT(w.OrderMaster_Date, '%d/%m/%Y') AS Order_Date, s.Staff_Name, c.Customer_Name
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            join OrderMaster w on w.OrderMaster_ID = o.OrderMaster_ID
            join Customer c on c.Customer_ID = w.Customer_ID
            join Staff s on s.Staff_ID = c.Staff_ID
            WHERE w.OrderMaster_Date between '$from' and '$to'";
    }else{
        $query = "SELECT OrderDetail_ID, p.Product_Name, Quantity, p.Selling_Price,(o.Quantity*p.Selling_Price) AS Amount, DATE_FORMAT(Delivery_Date, '%d/%m/%Y') AS Date, DATE_FORMAT(w.OrderMaster_Date, '%d/%m/%Y') AS Order_Date, s.Staff_Name, c.Customer_Name
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            join OrderMaster w on w.OrderMaster_ID = o.OrderMaster_ID
            join Customer c on c.Customer_ID = w.Customer_ID
            join Staff s on s.Staff_ID = c.Staff_ID";
    }
                $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                               
                echo '<tr>';
                echo '<td>'. $row['OrderDetail_ID'].'</td>';
                echo '<td>'. $row['Customer_Name'].'</td>';
                echo '<td>'. $row['Order_Date'].'</td>';
                echo '<td>'. $row['Product_Name'].'</td>';
                echo '<td>'. number_format($row['Quantity']).'</td>';
                echo '<td>'. number_format($row['Selling_Price']).'</td>';
                echo '<td>'. number_format($row['Amount']).'</td>';
                echo '<td>'. $row['Staff_Name'].'</td>';        
                echo '</tr>'; 
                               
                    }
?>              
          
                </tbody>
                    <tfoot>
<?php if(isset($_POST['find'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
  $query = "SELECT  SUM(o.Quantity*p.Selling_Price) AS total
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            join OrderMaster w on w.OrderMaster_ID = o.OrderMaster_ID
            join Customer c on c.Customer_ID = w.Customer_ID
            join Staff s on s.Staff_ID = c.Staff_ID
            WHERE w.OrderMaster_Date between '$from' and '$to'";
    }else{
        $query = "SELECT SUM(o.Quantity*p.Selling_Price) AS total
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            join OrderMaster w on w.OrderMaster_ID = o.OrderMaster_ID
            join Customer c on c.Customer_ID = w.Customer_ID
            join Staff s on s.Staff_ID = c.Staff_ID";
    }
                $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                        echo'<tr>';
                        echo'<td colspan="6" style="text-align:right"> Total </td>';
                         echo'<td colspan="2">'. number_format($row['total']).'</td>';
                         echo'</tr>'; 
    ?>
                    </tfoot>              
                 </table>
              </div>
            </div>
        </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>