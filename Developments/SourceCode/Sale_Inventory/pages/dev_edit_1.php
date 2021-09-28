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
        $query = "SELECT OrderDetail_ID, Quantity, DATE_FORMAT(Delivery_Date, '%d/%m/%Y') AS Date, Delivery_Status, w.Product_ID, p.Product_Name, OrderMaster_ID, Warehouse
            FROM OrderDetail w 
            join Product p on p.Product_ID = w.Product_ID
            where OrderDetail_ID = '$id'";
        
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result))
          {   
            $a = $row['OrderDetail_ID'];
            $b = $row['Quantity'];
            $c = $row['Date'];
            $d = $row['Delivery_Status'];
            $e = $row['Product_Name'];
            $f = $row['Warehouse'];
            $g = $row['OrderMaster_ID'];
            $h = $row['Product_ID'];
          }
        $qry = "SELECT c.Customer_Name FROM OrderMaster w JOIN Customer c ON c.Customer_ID = w.Customer_ID 
                WHERE OrderMaster_ID = '$g'";
        $rs = mysqli_query($conn, $qry);
        $rw = mysqli_fetch_array($rs);
        
      ?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Update Delivery</h4>
            </div>
          <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="delivery.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          
            <form role="form" method="post" action="dev_edit1.php" >
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Order Detail ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="id" value="<?php echo $a ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Customer Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="cust" value="<?php echo $rw[0]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="code" value="<?php echo $h; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Quantity:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="quantity" value="<?php echo $b; ?>" readonly>
                </div>
              </div>
               <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Delivery Date:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="date" value="<?php echo $c; ?>" readonly>
                </div>
              </div> 
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Delivery Status:
                </div>
                <div class="col-sm-9">
                   <select class="form-control" name="status" required> 
                            <?php 
                                $query = "select Delivery_Status from OrderDetail where OrderDetail_ID = '$id'";
                                $rs = mysqli_query($conn, $query); // DBConnect.php
                                    while($id = mysqli_fetch_array($rs)):
                                      echo '<option> '.$id[0] .' </option>';
                                    endwhile;
                            ?>
                       <option>prepare</option>
                       <option>delivery</option>
                       <option>done</option>
                   </select>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Warehouse ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="warehouse" value="<?php echo $f; ?>" required>
                </div>
              </div>

              <hr>

                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update this delivery ?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
                    
            </div>
          </div></center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>