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
            
            <div class="card shadow mb-4">
                        
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Tax Code</th>
                        <th>Address</th>
                        <th>Staff Name</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = "SELECT Customer_ID, Customer_Name, Tax_Code, Address, s.Staff_Name 
                               FROM customer c JOIN Staff s ON c.Staff_ID = s.Staff_ID";
                      $result = mysqli_query($conn, $query);
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['Customer_ID'].'</td>';
                      echo '<td>'. $row['Customer_Name'].'</td>';
                      echo '<td>'. $row['Tax_Code'].'</td>';
                      echo '<td>'. $row['Address'].'</td>';
                      echo '<td>'. $row['Staff_Name'].'</td>';
                    
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="cust_searchfrm_view_logistics.php?action=edit & id='.$row['Customer_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> More</a>
                            
                          </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>