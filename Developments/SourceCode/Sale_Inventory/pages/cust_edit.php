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
  $query = "SELECT Customer_ID, Customer_Name, Tax_Code, Address, Email, Phone, Person, Contact, c.Staff_ID, s.Staff_Name
            FROM Customer c
            join Staff s on s.Staff_ID = c.Staff_ID
            WHERE Customer_ID ='$id'";
  $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['Customer_ID'];
      $i= $row['Customer_Name'];
      $a=$row['Tax_Code'];
      $b=$row['Address'];
      $c=$row['Email'];
      $d=$row['Phone'];
      $e=$row['Person'];
      $f=$row['Contact'];
      $g=$row['Staff_ID'];
      $h = $row['Staff_Name'];
    }  
      
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Customer</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="customer.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="cust_edit1.php">
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Customer ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control"  name="id" value="<?php echo $zz; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Customer Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control"  name="name" value="<?php echo $i; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Tax Code:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  name="code" value="<?php echo $a; ?>" readonly>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Address:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" name="address" value="<?php echo $b; ?>" readonly>
                </div>
                </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  name="email" value="<?php echo $c; ?>" readonly>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Phone:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  name="phone" value="<?php echo $d; ?>" readonly>
                </div>
                </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Person:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  name="person" value="<?php echo $e; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Contact:
                </div>
                <div class="col-sm-9">
                   <input class="form-control"  name="contact" value="<?php echo $f; ?>" required>
                </div>
              </div>
                <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Sale in charge:
                </div>
                <div class="col-sm-9">
                    <select class="form-control" name="sale" required>
                        <option value="<?php echo $g; ?>"><?php echo $h; ?> </option>
                                    <?php 
                                    $query = "select Staff_ID, Staff_Name from Staff where Department = 'Sale' and Staff_ID != '$g'";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $count = mysqli_num_rows($rs);
                                        if($count == 0):
                                            echo 'Record not found';
                                        else:
                                            while($dept = mysqli_fetch_array($rs)):
                                                echo '<option value="'.$dept[0].'"> '.$dept[1] .' </option>';
                                            endwhile;

                                        endif;

                                    ?>

                                </select>
                   
                </div>
              </div>
              <hr>

                <button type="submit" name="btnUpdate" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update Customer information ?')"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>