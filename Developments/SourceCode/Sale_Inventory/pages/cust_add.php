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
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">ADD NEW CUSTOMER</h4>
            </div>
            <a href="customer.php" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>
            <div class="card-body">
                        <div class="table-responsive">
                        <form role="form" method="post" action="cust_transac.php?action=add">
                          <div class="form-group">
                              <?php 
                                    $query = "select MAX(Customer_ID) from Customer";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $field = mysqli_fetch_array($rs);
                                    $newID = ++$field[0];
                                    ?>
                              <input class="form-control" placeholder="Customer ID" name="id" value="<?= $newID ?>" readonly>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Customer Name" name="name" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Tax Code" name="code" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Address" name="address" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Phone Number" name="phone" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Purchasing" name="purchasing" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Contact" name="contact" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="saleid">
                                    
                                    <?php 
                                    $query = "select * from Staff WHERE Role_ID = 'S01' OR Role_ID = 'S02'";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $count = mysqli_num_rows($rs);
                                        if($count == 0):
                                            echo 'Record not found';
                                        else:
                                            while($fields = mysqli_fetch_array($rs)):
                                                echo '<option value="'.$fields[0] .'"> '.$fields[1].' </option>';
                                            endwhile;

                                        endif;

                                    ?>

                                </select>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<?php
include'../includes/footer.php';
mysqli_close($conn);
?>