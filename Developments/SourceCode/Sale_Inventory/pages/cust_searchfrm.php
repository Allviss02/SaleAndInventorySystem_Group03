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
  $query = "SELECT * FROM Customer WHERE Customer_ID ='$id'";
  $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['Customer_ID'];
      $i= $row['Customer_Name'];
      $c= $row['Email'];
      $d= $row['Phone'];
      $a=$row['Person'];
      $b=$row['Contact'];
    }
   
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Customer's more detail</h4>
            </div>
            <a href="customer.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Customer ID<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $zz; ?> <br>
                        </h5>
                      </div>

                    </div>
                <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Customer Name<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $i; ?> <br>
                        </h5>
                      </div>

                    </div>
                <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Email<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $c; ?> <br>
                        </h5>
                      </div>

                    </div>
                <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Phone<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $d; ?> <br>
                        </h5>
                      </div>

                    </div>
                <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Contact person <br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a; ?> <br>
                        </h5>
                      </div>

                    </div>
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Mobile Phone<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $b; ?> <br>
                        </h5>
                      </div>
                      
                    </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>