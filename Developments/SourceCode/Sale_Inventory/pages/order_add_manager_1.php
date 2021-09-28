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

          <center><div class="card shadow mb-4 col-xs-12 col-md-10 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">New Sale order</h4>
            </div>
                  <a href="order_approve.php" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>
            <div class="card-body">
              <div class="table-responsive">
                  <form role="form" method="post" action="order_transac_manager.php" >
                            
                            <div class="form-group">
                                
                                <?php 
                                    $query = "select MAX(OrderMaster_ID) from OrderMaster";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $field = mysqli_fetch_array($rs);
                                    $newID = ++$field[0];
                                    
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $today = date("Y-m-d H:i:s");  
                                    ?>
<!--                            <p style="text-align: left; color: blue;"> The lastest Staff ID is <?php echo $field[0]?></p>-->
                            <p style="text-align: left; color: blue;"> Order ID: </p>
                            <input class="form-control" name="id" value="<?= $newID ?>" readonly>
                              
                            </div>
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Order Date: </p>
                              <input class="form-control" name="date" value="<?= $today ?>" readonly>
                            </div>
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Customer Name: </p>
                              <select class="form-control" name="custid" required> 
                                  <option></option>
                                            <?php 
                                            $query = "select Customer_ID, Customer_Name from Customer where Staff_ID = '$session'";
                                            $rs = mysqli_query($conn, $query); // DBConnect.php
                                                while($id = mysqli_fetch_array($rs)):
                                                    echo '<option value="'.$id[0].'"> '.$id[1] .' </option>';
                                                endwhile;
                                            ?>
                                </select>
                            </div>
                            
                            
                            <p style="text-align: left; color: blue;"> Order detail information: </p>
                            <table class="table-responsive table-hover table-bordered">
                                <thead>
                                  <tr style="text-align: center">
                                      <td class=" col-md-1" > Detail ID </td>
                                      <td class=" col-md-1" > Product Name </td>
                                      <td class=" col-md-1" > Quantity </td>
                                      <td class=" col-md-1" > Price </td>
                                      <td class=" col-md-1"> Amount </td>
                                      <td class=" col-md-1"> Delivery date </td>
                                      
                                  </tr> 
                                </thead>
                                <tbody id="tbody">  

                            </tbody>
 
                              </table>
                            <p style="text-align: right;">
                                <button type="button" class="btn-success" onclick="addItem();"> 
                                    Add product
                                </button>
                            </p>
                            <div class="form-group">
                              <p style="color: blue;"> Total Amount : </p>
                              <input type="number" min="0" max="99999999999" step="100000" class="form-control col-md-3"  style="text-align: center" name="total">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Add Sale Order</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<?php 
        $query = "select MAX(OrderDetail_ID) from OrderDetail";
        $rs = mysqli_query($conn, $query); // DBConnect.php
        $field = mysqli_fetch_array($rs);
        $new1 = $field[0];

    ?>
<script>
    var id = "<?php echo $new1; ?>";
    var idd = id.substring(3);
 
    function addItem(){
        idd++;
        var html ="<tr style='text-align: center'>";
            html += "<td><input class='form-control' name='detailid[]' value='"+'OD0'+idd+"'></td>";
            html += "<td><select class='form-control' id='product' name='product[]' required><option></option>\n\
                <?php $query = 'select Product_ID from Product';$rs = mysqli_query($conn, $query);
                      while($id = mysqli_fetch_array($rs)):
                      echo '<option> '.$id[0] .' </option>';
                      endwhile;
                ?></select></td>";
            html += "<td><input type='number' min='0' max='99999999' step='25' class='form-control'  name='quantity[]' required></td>";
            
            html += "<td><select class='form-control' name='price[]' required><option></option>\n\
                <?php $query = 'select distinct Selling_Price from Product';$r = mysqli_query($conn, $query);
                      while($id = mysqli_fetch_array($r)):
                      echo '<option> '. number_format($id[0]) .' </option>';
                      endwhile;
                ?></select></td>";
            html += "<td><input type='number' min='0' max='99999999999' step='100000' class='form-control'  name='amount[]' required ></td>";
            html += "<td><input class='form-control' type='date' name='dedate[]' required></td>";
            
        html += "</tr>";
        
        document.getElementById("tbody").insertRow().innerHTML = html;
       
            
    };
    
    
</script>
 
<?php

include '../includes/footer.php';
mysqli_close($conn);
?>


<!-- HOW TO PRINT YOUR VALUE JUST FOR CHECKINGGGGG
<script language='JavaScript'>
function getwords()
{
textbox = document.getElementById('FromDate');
if (textbox.value != "")
document.write("You entered: " + textbox.value)
else
alert("No word has been entered!")
}
</script>
<input type="button" onclick="getwords()" value="Enter" /> -->