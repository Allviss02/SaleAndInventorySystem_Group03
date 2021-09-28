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
<?php
  $id = $_GET['id'];
  $query = "SELECT OrderDetail_ID, p.Product_Name, Quantity,Delivery_Status, Ware01, Qty_Ware01, Ware02, Qty_Ware02
            FROM OrderDetail o
            join Product p on p.Product_ID = o.Product_ID
            WHERE o.OrderDetail_ID = '$id'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
                        
                       $a = $row['OrderDetail_ID'];
                        $c = $row['Product_Name'];
                        $d = $row['Quantity'];
//                        $e = $row['Department'];
                        $f = $row['Delivery_Status'];
                        $g = $row['Ware01'];
                        $h = $row['Qty_Ware01'];
                        $i = $row['Ware02'];
                        $j = $row['Qty_Ware02'];
            }
    
?>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Delivery detail</h4>
            </div>
            <a href="delivery.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          

                
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          Order Detail ID<br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp;   <?php echo $id; ?> <br>
                        </h5>
                      </div>
                    </div>
<!--                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Customer Name <br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : &ensp;   <?php echo $b; ?> <br>
                        </h5>
                      </div>
                    </div>-->
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          Product Name <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $c; ?> <br>
                        </h5>
                      </div>
                    </div> 
                <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          Quantity order <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          :&ensp; <?php echo $d; ?> <br>
                        </h5>
                       </div>
                    </div>  
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          Delivery Status <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $f; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                         1st Warehouse ID  <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $g; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          1st Warehouse Quantity <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $h; ?> <br>
                        </h5>
                      </div>
                    </div>
                     <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                         2nd Warehouse ID  <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $i; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-4 text-primary">
                        <h5>
                          2nd Warehouse Quantity <br>
                        </h5>
                      </div>
                      <div class="col-sm-8">
                        <h5>
                          : &ensp; <?php echo $j; ?> <br>
                        </h5>
                      </div>
                    </div>
                    </div>

          </div>
          </center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>