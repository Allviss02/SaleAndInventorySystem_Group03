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
  $id = $_GET['code'];
  $query = "SELECT * FROM Product WHERE Product_ID = '$id'";
  $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {   
      $zz = $row['Product_ID'];
      $zzz = $row['Product_Name'];
      $A = $row['Packing'];
      $B = $row['Supplier'];
      $C = $row['Origin'];
      $D = $row['Selling_Price'];
      
    }
      
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Product</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>
            <div class="card-body">

            <form role="form" method="post" action="pro_edit1.php">
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product ID:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="id" value="<?php echo $zz; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="name" value="<?php echo $zzz; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Packing:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="packing" value="<?php echo $A; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Supplier:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="supplier" value="<?php echo $B; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Origin:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="origin" value="<?php echo $C; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Selling Price:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="price" type="number" min="0" max="9999999" step="500" value="<?php echo $D ?>" required>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update ?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>