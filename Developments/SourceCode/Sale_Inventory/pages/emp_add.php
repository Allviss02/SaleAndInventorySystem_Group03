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

<script type="text/javascript">
    function kiemtra(){
        var reMail = /^\w+[@]\w+[.]\w+([.]\w+)?$/;
              var sMail = dangky.email.value;
              if(!reMail.test(sMail)){
                  alert("Email is incorrect !"); 
                  dangky.email.value="";
                  dangky.email.focus();
                  return false;
              }
        var rephone = /^[0-9]{10}$/;
            var sphone = dangky.phone.value;
            if(!rephone.test(sphone)){
                alert("Phone should be 10 numbers !"); 
                      dangky.phone.value="";
                      dangky.phone.focus();
                      return false;
            }
        var repass = /^\w{5,}$/;
            var spass = dangky.password.value;
            if(!repass.test(spass)){
                alert("Pasword should be atleast 5  characters !"); 
                      dangky.password.value="";
                      dangky.password.focus();
                      return false;
            }
            
    }
    
</script>

          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add New Staff</h4>
            </div>
            <a href="employee.php?action=add" type="button" class="btn btn-primary bg-gradient-primary"><i class="fas fa-flip-horizontal fa-fw fa-share"></i>Back</a>
            <div class="card-body">
              <div class="table-responsive">
                        <form name="dangky" role="form" method="post" action="emp_transac.php?action=add" onsubmit="return kiemtra();">
                            
                            <div class="form-group">
                            <p style="text-align: left; color: blue;"> Staff ID : </p>    
                                <?php 
                                    $query = "select MAX(Staff_ID) from Staff";
                                    $rs = mysqli_query($conn, $query); // DBConnect.php
                                    $field = mysqli_fetch_array($rs);
                                    $newID = ++$field[0];
                                    ?>
<!--                            <p style="text-align: left; color: blue;"> The latest Staff ID is <?php echo $field[0]?></p>-->
                            
                            <input class="form-control" placeholder="Staff ID " name="id" value="<?= $newID ?>" readonly>
                              
                            </div>
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Staff Name : </p>
                              <input class="form-control" placeholder="Staff Name" name="name" required>
                            </div>
                            <div class="form-group">
                                <p style="text-align: left; color: blue;"> Staff Email : </p>
                              <input class="form-control" type="email" placeholder="Email: abc@gmail.com" name="email" required>
                            </div>
                            <div class="form-group">
                               <p style="text-align: left; color: blue;"> Mobile number : </p>
                              <input class="form-control" type="number" placeholder="Mobile Number 10 numbers" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                              <p style="text-align: left; color: blue;"> Password : </p>
                              <input class="form-control" placeholder="Password at least 5 characters" type="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <p style="text-align: left; color: blue;"> Position : </p>
                              <select class="form-control" name="role" required>
                                  <option> </option>
                                    <?php 
                                    $query = "select * from Role where Role_ID = 'S01' or Role_ID = 'A01' or Role_ID = 'L01'";
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
                            <button type="submit" class="btn btn-success btn-block"
                                    onclick="return confirm('Are you sure to add new Staff ?')"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
        
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