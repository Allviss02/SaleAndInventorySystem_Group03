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
    xmlhttp.open("GET","us_edit.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

        <!-- ADMIN TABLE -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Account(s)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form>
                    <select name="users" onchange="showUser(this.value)">
                    <option value="">Select a Role Name:</option>
                    <option value="AD01">Admin</option>
                    <option value="S01">Sale Executive</option>
                    <option value="S02">Sale Manager </option>
                    <option value="L01">Logistics Executive</option>
                    <option value="L02">Logistics Manager</option>
                    <option value="A01">Accountant</option>
                    <option value="A02">General Accountant</option>
                    </select>
                    <br>
                    <div id="txtHint"><b>User info will be listed here.</b></div>
                    </form>
                    
                </div>
            </div>
        </div>
<?php
include'../includes/footer.php';
mysqli_close($conn);

?>

  