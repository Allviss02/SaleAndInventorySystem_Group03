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
        $qry = "SELECT Approval FROM OrderMaster WHERE OrderMaster_ID = '$id'";
        $res = mysqli_query($conn, $qry);
        $row = mysqli_fetch_array($res);
        if($row[0] == "approval" || $row[0] == "refusal"){
            ?>
            <script type="text/javascript">
			alert("You can not edit approval or refusal Sale order.");
			window.location = "order.php";
		</script>
        <?php
        }else{
        
        $query = "SELECT OrderMaster_ID, DATE_FORMAT(OrderMaster_Date, '%d/%m/%Y %H-%m-%s') AS Date, Total_Amount,Approval, w.Customer_ID,c.Customer_Name
            FROM OrderMaster w 
            join Customer c on c.Customer_ID = w.Customer_ID
            where OrderMaster_ID = '$id'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result))
          {   
            $a = $row['OrderMaster_ID'];
            $b = $row['Date'];
            $c = $row['Customer_Name'];
            $d = number_format($row['Total_Amount']);
            $e = $row['Approval'];
            $f = $row['Customer_ID'];
          }
            
      ?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Sale Order Master</h4>
            </div>
          <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="order.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          
            <form role="form" method="post" >
              
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
                    <select class="form-control" name="name" required> 
                        <option value="<?php echo $f ?>"> <?php echo $c ?></option>
                            <?php 
                                $query = "select Customer_ID, Customer_Name from Customer  
                                        where Staff_ID = '$session' and Customer_ID != '$f'";
                                $rs = mysqli_query($conn, $query); // DBConnect.php
                                    while($id = mysqli_fetch_array($rs)):
                                      echo '<option value='.$id[0].'> '.$id[1] .' </option>';
                                    endwhile;
                            ?>
                       
                   </select>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Total Amount:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="total" value="<?php echo $d; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Approval:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $e; ?>" readonly> 
                </div>
              </div>
              <hr>
                <button type="submit" name="submit"  class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update sale order ?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
                    
            </div>
          </div></center>

<?php
        
          }
          if(isset($_POST["submit"])){      
          $id = $_POST['id'];
                        $name = $_POST['name'];
			$total = $_POST['total'];

            $query = "UPDATE OrderMaster SET Total_Amount = '$total', Customer_ID = '$name' WHERE OrderMaster_ID = '$id'";
            $result = mysqli_query($conn, $query);

							
?>	
	<script type="text/javascript">
			alert("You've update Sale order Successfully.");
			window.location = "order.php";
		</script>
<?php
          }
include'../includes/footer.php';
mysqli_close($conn);
