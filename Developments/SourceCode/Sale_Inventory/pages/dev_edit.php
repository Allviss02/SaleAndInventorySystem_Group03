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
        $query = "SELECT OrderDetail_ID, Quantity, DATE_FORMAT(Delivery_Date, '%d/%m/%Y') AS Date, Delivery_Status, w.Product_ID, p.Product_Name, OrderMaster_ID, Ware01, Qty_Ware01, Ware02, Qty_Ware02
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
            $f = $row['Ware01'];
            $g = $row['OrderMaster_ID'];
            $h = $row['Product_ID'];
            $i = $row['Qty_Ware01'];
            $j = $row['Ware02'];
            $k = $row['Qty_Ware02'];
          }
        $qry = "SELECT c.Customer_Name FROM OrderMaster w JOIN Customer c ON c.Customer_ID = w.Customer_ID 
                WHERE OrderMaster_ID = '$g'";
        $rs = mysqli_query($conn, $qry);
        $rw = mysqli_fetch_array($rs);
        
      ?>
<script>
    function kiemtra(){
        
        var reID = /^(WH)+[0-9]{2}$/;
            var sID = dangky.ware01.value;
              if(!reID.test(sID)){
                  alert("1st Warehouse ID is incorrect !"); 
                  dangky.ware01.value="";
                  dangky.ware01.focus();
                  return false;
              }
        var rID = /^(WH)+[0-9]{2}$/;
            var seID = dangky.ware02.value;
              if(!rID.test(seID)){
                  alert("2nd Warehouse ID is incorrect !"); 
                  dangky.ware02.value="";
                  dangky.ware02.focus();
                  return false;
              }
    }
</script>
  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Update Delivery</h4>
            </div>
          <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="delivery.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          
            <form role="form" name="dangky" method="post" action="dev_edit1.php" onsubmit="return kiemtra();">
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Order Detail ID:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="id" value="<?php echo $a ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Customer Name:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="cust" value="<?php echo $rw[0]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="code" value="<?php echo $h; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Quantity:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="quantity" value="<?php echo $b; ?>" readonly>
                </div>
              </div>
               <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Delivery Date:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="date" value="<?php echo $c; ?>" readonly>
                </div>
              </div> 
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 Delivery Status:
                </div>
                <div class="col-sm-8">
                   <select class="form-control" name="status" required> 
                            <?php 
                                $query = "select Delivery_Status from OrderDetail where OrderDetail_ID = '$id'";
                                $rs = mysqli_query($conn, $query); // DBConnect.php
                                  $id = mysqli_fetch_array($rs);
                                if($id[0] == null){
                                    echo '<option> '.$id[0] .' </option>';
                                    echo '<option> prepare </option>';
                                }else if($id[0] == 'prepare'){
                                    echo '<option> '.$id[0] .' </option>';
                                    echo '<option> delivery </option>';
                                }else if($id[0] == 'delivery'){
                                    echo '<option> '.$id[0] .' </option>';
                                    echo '<option> done </option>';
                                }else if($id[0] == 'done'){
                                    echo '<option> '.$id[0] .' </option>';
                                }
                            ?>
<!--                       <option>prepare</option>
                       <option>delivery</option>
                       <option>done</option>-->
                   </select>
                </div>
              </div>
        <?php
//              $qry = "select Delivery_Status from OrderDetail where OrderDetail_ID = '$id'";
//                    $r = mysqli_query($conn, $qry); // DBConnect.php
//                       $i = mysqli_fetch_array($r);
                    if($id[0] == null){
                     
        ?>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 1st Warehouse ID:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="ware01" type="text" value="<?php echo $f; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 1st Warehouse quantity:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="qty_ware01" type="number" min="0" step="25" max="999999" value="<?php echo $i; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 2nd Warehouse ID:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="ware02" type="text" value="<?php echo $j; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 2nd Warehouse quantity:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="qty_ware02" type="number" min="0" step="25" max="999999" value="<?php echo $k; ?>" required>
                </div>
              </div>
        <?php }else{
            ?>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 1st Warehouse ID:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="ware01" type="text" value="<?php echo $f; ?>" readonly>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 1st Warehouse quantity:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="qty_ware01" type="number" min="0" step="25" max="999999" value="<?php echo $i; ?>" readonly>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 2nd Warehouse ID:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="ware02" type="text" value="<?php echo $j; ?>" readonly>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-4" style="padding-top: 5px;">
                 2nd Warehouse quantity:
                </div>
                <div class="col-sm-8">
                    <input class="form-control" name="qty_ware02" type="number" min="0" step="25" max="999999" value="<?php echo $k; ?>" readonly>
                </div>
              </div>
    <?php
        }
    ?>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update this delivery ?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th class="col-md-1" >Warehouse ID</th>
                     <th class="col-md-1" >Product ID</th>
                     <th class="col-md-1" >Product Name</th>
                     <th class="col-md-1" >Receipt Date</th>
                     <th class="col-md-1" >Pending</th>
                     <th class="col-md-1" >Selling</th>
                     <th class="col-md-1" >Stock</th>
                    
                   </tr>
               </thead>
          <tbody>
    <?php    
    $q = "SELECT w.Warehouse_ID, w.Product_ID, p.Product_Name, DATE_FORMAT(r.Receipt_Date, '%d/%m/%Y %H:%m:%s') AS Date, w.Pending, w.Selling,(w.Receipt_Quantity - w.Pending - w.Selling) AS Stock
            FROM Warehouse w 
            join Receipt r on w.Receipt_ID = r.Receipt_ID 
            join Product p on w.Product_ID = p.Product_ID
            where w.Product_ID = '$h'";
        $r = mysqli_query($conn, $q);
        while ($re = mysqli_fetch_array($r)) {
                                 
                echo '<tr>';
                echo '<td>'. $re['Warehouse_ID'].'</td>';
                echo '<td>'. $re['Product_ID'].'</td>';
                echo '<td>'. $re['Product_Name'].'</td>';
                echo '<td>'. $re['Date'].'</td>';
                echo '<td>'. $re['Pending'].'</td>';
                echo '<td>'. $re['Selling'].'</td>';
                echo '<td>'. $re['Stock'].'</td>';
                echo '<tr>';
        }
              ?>
              </tbody>
            </table>
            </div>
          </div></center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>