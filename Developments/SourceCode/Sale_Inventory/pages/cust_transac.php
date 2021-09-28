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
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $id = $_POST['id'];
              $name = $_POST['name'];
              $code = $_POST['code'];
              $address = $_POST['address'];
              $email = $_POST['email'];
              $phone = $_POST['phone'];
              $purchasing = $_POST['purchasing'];
              $contact = $_POST['contact'];
              $sale = $_POST['saleid'];
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO Customer
                    VALUES ('$id','$name','$code','$address','$email','$phone','$purchasing','$contact','$sale')";
                    $result = mysqli_query($conn, $query);
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>