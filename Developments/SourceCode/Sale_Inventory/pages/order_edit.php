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

        $id = $_GET['id'];
        $query = "SELECT w.OrderMaster_ID, DATE_FORMAT(OrderMaster_Date, '%d/%m/%Y %H:%m:%s') AS Date,Approval, c.Customer_Name,SUM(p.Quantity*k.Selling_Price) AS total
            FROM OrderMaster w 
            join Customer c on c.Customer_ID = w.Customer_ID 
            join OrderDetail p on p.OrderMaster_ID = w.OrderMaster_ID
            join Product k on k.Product_ID = p.Product_ID
            where w.OrderMaster_ID = '$id'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result))
          {   
            $a = $row['OrderMaster_ID'];
            $b = $row['Date'];
            $c = $row['Customer_Name'];
            $d = number_format($row['total']);
            $e = $row['Approval'];
          }
            
      ?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Approval Sale Order</h4>
            </div>
          <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="order_approve.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          
            <form role="form" method="post" action="order_edit1.php" >
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Order Master ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="id" value="<?php echo $a ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Order Date:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="date" value="<?php echo $b; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Customer Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="name" value="<?php echo $c; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Total Amount:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="total" value="<?php echo $d; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Approval:
                </div>
                <div class="col-sm-9">
                   <select class="form-control" name="approval" required> 
                            <?php 
                                $query = "select Approval from OrderMaster where OrderMaster_ID = '$id'";
                                $rs = mysqli_query($conn, $query); // DBConnect.php
                                    while($id = mysqli_fetch_array($rs)):
                                      echo '<option> '.$id[0] .' </option>';
                                    endwhile;
                            ?>
                       <option>approval</option>
                       <option>refusal</option>
                   </select>
                </div>
              </div>
              

              <hr>

                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to approve sale order ?')"><i class="fa fa-edit fa-fw"></i>Approval</button>    
              </form>  
                    
            </div>
          </div></center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>