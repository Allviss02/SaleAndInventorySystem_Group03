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
              <h4 class="m-2 font-weight-bold text-primary">New Receipt</h4>
            </div>
                  <a href="inventory.php" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>
            <div class="card-body">
              <div class="table-responsive">
                        <form role="form" method="post" action="inv_transac.php" >
                            
                            <div class="form-group">
                                
                                <?php 
                                    $query = "select MAX(Receipt_ID), MAX(Purchasing_Order) from Receipt";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $field = mysqli_fetch_array($rs);
                                    $newID = ++$field[0];
                                    $newPo = ++$field[1];
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $today = date("Y-m-d H:i:s");  
                                    ?>
<!--                            <p style="text-align: left; color: blue;"> The lastest Staff ID is <?php echo $field[0]?></p>-->
                            <p style="text-align: left; color: blue;"> Receipt ID: </p>
                            <input class="form-control" name="id" value="<?= $newID ?>" readonly>
                              
                            </div>
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Receipt Date: </p>
                              <input class="form-control" name="date" value="<?= $today ?>" readonly>
                            </div>
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Purchasing Order: </p>
                              <input class="form-control" name="po" value="<?= $newPo ?>" readonly>
                            </div>
                            
                            
                            <p style="text-align: left; color: blue;"> Product information: </p>
                            <table class="table-responsive table-hover table-bordered">
                                <thead>
                                  <tr style="text-align: center">
                                      <td class=" col-md-1" > Warehouse ID </td>
                                      <td class=" col-md-1" > Product ID </td>
                                      <td class=" col-md-1" > Receipt Quantity </td>
                                      <td class=" col-md-1"> Lot number </td>
                                      <td class=" col-md-1"> Production date </td>
                                      <td class="col-md-1"> Expiration date </td>
                                  </tr> 
                                </thead>
                                <tbody id="tbody">  

                            </tbody>
                   
                              </table>
                            <p style="text-align: right;">
                                <button type="button" class="btn-success" onclick="addItem();"> 
                                    Add product
                                </button>
                                <button type="button" class="btn-danger" onclick="deleteItem();"> 
                                    Delete product
                                </button>
                            </p>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Add inventory</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<?php $qry = "select MAX(Warehouse_ID) from Warehouse";
                          $rs = mysqli_query($conn, $qry);$w = mysqli_fetch_array($rs);
                          $new1 = $w[0];
    ?>
<script>
    
    var id = "<?php echo $new1; ?>";
    var idd = id.substring(3);
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if(dd<10){
      dd='0'+dd
    } 
    if(mm<10){
      mm='0'+mm
    } 

    today = yyyy+'-'+mm+'-'+dd;

    function addItem(){
        idd++;
        var html ="<tr style='text-align: center'>";
            html += "<td><input class='form-control' name='warehouse[]' value='"+'WH0'+idd+"'></td>";
            html += "<td><select class='form-control' name='product[]' required><option></option>\n\
                <?php $query = 'select Product_ID from Product';$rs = mysqli_query($conn, $query);
                      while($id = mysqli_fetch_array($rs)):
                      echo '<option> '.$id[0] .' </option>';
                      endwhile;
                ?></select></td>";
            html += "<td><input class='form-control' type='number' min='0' name='quantity[]' required></td>";
            html += "<td><input class='form-control' name='lot[]' required></td>";
            html += "<td><input class='form-control' type='date' max='"+today+"' name='pro[]' required></td>";
            html += "<td><input class='form-control' type='date' min='"+today+"' name='exp[]' required></td>";
        html += "</tr>";
        document.getElementById("tbody").insertRow().innerHTML = html;
    }
    function deleteItem(){
       var table = document.getElementById("tbody");
       var rowCount = table.rows.length;
       table.deleteRow(rowCount -1); 
       idd--;
   }

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