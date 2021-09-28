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
<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","order_product.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

          <center>
               <div class="card shadow mb-4 col-xs-12 col-md-10 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">New Sale order</h4>
            </div>
                  <a href="order.php" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>

        <!-- ADMIN TABLE -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Product list</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form>
                    <select name="product" onchange="showUser(this.value)">
                    <option value="">Select Category product</option>
                    <option value="1">Lactose</option>
                    <option value="2">Whey</option>
                    
                    </select>
                    <br>
                    <div id="txtHint"></div>
                    </form>
                    
                </div>
            </div>
        </div>
<?php

//session_start();
$product_ids = array();
//session_destroy();

//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'addpos')){
    if(isset($_SESSION['order_add'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['order_add']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['order_add'], 'code');

        if (!in_array(filter_input(INPUT_GET, 'code'), $product_ids)){
        $_SESSION['order_add'][$count] = array
            (
                'code' => filter_input(INPUT_GET, 'code'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'code')){
                    //add item quantity to the existing product in the array
                    $_SESSION['order_add'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['order_add'][0] = array
        (
            'code' => filter_input(INPUT_GET, 'code'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['order_add'] as $key => $product){
        if ($product['code'] == filter_input(INPUT_GET, 'code')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['order_add'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['order_add'] = array_values($_SESSION['order_add']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
                ?>                       
                    
            
            <div class="card-body">
              <div class="table-responsive">
                  <form role="form" method="post" action="order_transac.php" >
                            
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
<!--                                      <td class=" col-md-1" > Selling price </td>-->
                                      <td class=" col-md-1"> Amount </td>
                                      <td class=" col-md-1"> Delivery date </td>
                                      
                                  </tr> 
                                </thead>
                                <tbody id="tbody">  
                                    
                            </tbody>
 
                              </table>
                            
<!--                            <div class="form-group">
                              <p style="color: blue;"> Total Amount : </p>
                              <input type="number" min="0" max="99999999999" step="100000" class="form-control col-md-3" style="text-align: center" name="total">
                            </div>-->
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Add Sale Order</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<script>
    $(document).ready(function(){
        function load(){
            $.ajax({
                url:"cart.php",
                method="POST",
                success:function(data){
                    $('#tbody').html(data);
                }
            });
        }
        
    });
    
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