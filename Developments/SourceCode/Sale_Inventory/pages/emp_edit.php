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
        $query = "SELECT Staff_ID, Staff_Name, Staff_Email, Staff_Phone, Password, Working, s.Role_ID, r.Role_Name 
                    FROM Staff s 
                    join Role r on r.Role_ID = s.Role_ID
                    WHERE Staff_ID = '$id'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result))
          {   
            $zz = $row['Staff_ID'];
            $name = $row['Staff_Name'];
            $email = $row['Staff_Email'];
            $phone = $row['Staff_Phone'];
//            $dept = $row['Department'];
            $working = $row['Working'];
            $pass = $row['Password'];
            $role = $row['Role_ID'];
            $rname = $row['Role_Name'];
          }
            
      ?>
<script>
    function kiemtra(){
        var reMail = /^\w+[@]\w+[.]\w+([.]\w+)?$/;
              var sMail = dangky.email.value;
              if(!reMail.test(sMail)){
                  alert("Email is incorrect !"); 
                  dangky.email.value="";
                  dangky.email.focus();
                  return false;
              }
        var rePass = /^\w{5,}$/;
            var sPass = dangky.pass.value;
              if(!rePass.test(sPass)){
                  alert("Password is atleast 5 characters !"); 
                  dangky.pass.value="";
                  dangky.pass.focus();
                  return false;
              }
    }
</script>
  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Staff information</h4>
            </div>
          <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="employee.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
          
            <form role="form" name="dangky" method="post" action="emp_edit1.php" onsubmit="return kiemtra();">
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Staff ID:
                </div>
                <div class="col-sm-9">
                    <input class="form-control" name="id" value="<?php echo $zz ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Staff Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="email" type="email" value="<?php echo $email; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Password:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="pass" type="password" value="<?php echo $pass; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Role ID:
                </div>
                <div class="col-sm-9">
                    
                    <select class="form-control" name="role" required>
                        <option value="<?php echo $role; ?>"><?php echo $rname; ?> </option>
                                    <?php 
                                    if($role=="S01"){
                                        echo '<option value="S02"> Sale Manager </option>';
                                        
                                    }else if($role == "L01"){
                                        echo '<option value="L02"> Logistics Manager </option>';
                                    }else if($role == "S02"){
                                        echo '<option value="GM"> General Manager </option>';
                                    }else if($role == "A01"){
                                        echo '<option value="A02"> General Accountant </option>';
                                    }else if($role == "A02"){
                                        echo '<option value="GM"> General Manager </option>';
                                    }else if($role == "L02"){
                                        echo '<option value="GM"> General Manager </option>';
                                    }
//                                    $query = "select Role_ID,Role_Name from Role WHERE Role_Name != '$rname'";
//                                    $rs = mysqli_query($conn, $query); // DBConnect.php
//                                    $count = mysqli_num_rows($rs);
//                                        if($count == 0):
//                                            echo 'Record not found';
//                                        else:
//                                            while($dept = mysqli_fetch_array($rs)):
//                                                echo '<option value="'.$dept[0].'"> '.$dept[1] .' </option>';
//                                            endwhile;
//
//                                        endif;

                                    ?>

                                </select>
                   
                </div>
               
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Working:
                </div>
                <div class="col-sm-9"> 
                  <select class="form-control" name="working" required>
                        <option><?php echo $working; ?> </option>
                        <?php
                                    if($working == "on"){
                                        echo '<option> off </option>';
                                        
                                    }else if($working == "off"){
                                        echo '<option> on </option>';
                                    }
                        ?>
                  </select>
                </div>
              </div>
              <hr>
                <button type="submit" class="btn btn-warning btn-block"
                        onclick="return confirm('Are you sure to update Staff information?')"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
                    
            </div>
          </div></center>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>