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

        $query = "SELECT s.Staff_ID,Staff_Name,Staff_Email,Staff_Phone,Department, Manager_ID,Password,s.Role_ID,e.Role_Name
                    FROM  `Staff` s
                    JOIN `Role` e ON s.Role_ID = e.Role_ID 
                    WHERE s.Staff_ID = '$session'";
        $result = mysqli_query($conn, $query);
        if($result){
        while($row = mysqli_fetch_array($result))
          {  
                $zz= $row['Staff_ID'];
                $a= $row['Staff_Name'];
                $b=$row['Staff_Email'];
                $c=$row['Staff_Phone'];
                $d=$row['Department'];
                $e=$row['Manager_ID'];
                $f=$row['Password'];
                $g=$row['Role_Name'];
                
          }
        }
                
      ?>

<center><div class="card shadow mb-4 col-xs-6 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Account Info</h4>
            </div>
            <div class="card-body">
                <form method="post" action="settings_edit.php">
            <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Staff ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="email" name="email" value="<?php echo $zz; ?>" readonly>
                </div>
              </div>  
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Full Name:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" placeholder="email" name="email" value="<?php echo $a; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="email" name="email" value="<?php echo $b; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Phone:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="phone" name="phone" value="<?php echo $c; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Department:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="department" name="department" value="<?php echo $d; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Manager
                </div>
                <div class="col-sm-9">
                  <?php 
                    $qry = "select Staff_Name from Staff where Staff_ID = '$e'";
                    $res = mysqli_query($conn, $qry);
                    $r = mysqli_fetch_array($res);
                   
                  ?>
                  <input class="form-control" placeholder="manager" name="manager" value="<?php echo $r[0]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Password" name="password" value="<?php echo $f; ?>" readonly>
                </div>
              </div>
                
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Position:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Position" name="position" value="<?php echo $g; ?>" readonly>
                </div>
              </div>
              
              <hr>
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Change password</button>
                   
              </form>  
            </div>
    </div> </center>       

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>

