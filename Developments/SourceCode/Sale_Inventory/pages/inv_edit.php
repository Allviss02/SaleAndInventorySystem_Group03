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

  $query = "SELECT w.Warehouse_ID, w.Product_ID, p.Product_Name, w.Receipt_Quantity, w.Lot_Number, w.Production_Date, w.Expiration_Date, w.Pending, w.Selling, (w.Receipt_Quantity - w.Pending - w.Selling) AS Stock
            FROM Warehouse w 
            join Receipt r on w.Receipt_ID = r.Receipt_ID 
            join Product p on w.Product_ID = p.Product_ID
            WHERE w.Warehouse_ID = '$id'";
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
        $warehouse = $row['Warehouse_ID'];     
      $id = $row['Product_ID'];
      $name = $row['Product_Name'];
      $A = $row['Receipt_Quantity'];
      $B = $row['Pending'];
      $C = $row['Selling'];
      $D = $row['Stock'];
    }
      
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Inventory for Warehouse ID : <?php echo $warehouse ?></h4>
            </div>
            <a type="button" class="btn btn-primary bg-gradient-primary" href="inventory.php?action=edit & id='<?php echo $id; ?>'"><i class="fas fa-fw fa-flip-horizontal fa-share"></i> Back</a>
                
            <div class="card-body">

            <form role="form" method="post" action="inv_edit1.php">
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Warehouse ID:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="id" value="<?php echo $warehouse; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" value="<?php echo $name; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Receipt Quantity:
                </div>
                <div class="col-sm-9">
                    <input class="form-control qty" placeholder="Quantity"  value="<?php echo $A; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pending:
                </div>
                <div class="col-sm-9">
                  <input class="form-control prc" type="number" min="0" onblur="myFunction()" placeholder="Pending" name="pending" value="<?php echo $B; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Selling:
                </div>
                <div class="col-sm-9">
                    <input class="form-control prc" type="number" min="0" onblur="myFunction()" value="<?php echo $C; ?>" name="selling" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Stock:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" id="result" min="0" name="stock"  readonly value="<?php echo $D; ?>"> </input>
                    
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update Product inventory ?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>
<script src="jquery-3.5.1.min.js"> </script>
<script>
    $('.form-group').on('input','.prc',function(){
        var totalSum = 0;
        var stock = 0;
        var inventory = $('.qty').val();
        $('.form-group .prc').each(function(){
            var inputVal = $(this).val();
            if($.isNumeric(inputVal)){
                totalSum += parseFloat(inputVal);
            }
                stock = parseFloat(inventory) - parseFloat(totalSum);
            
        });
        $('#result').val(stock);
    });
  function myFunction(){
  var x = document.getElementById('result').value;
  if(x < 0){
      alert("Stock can not be negative");
      
  }
}
</script>
<?php
include'../includes/footer.php';
mysqli_close($conn);
?>