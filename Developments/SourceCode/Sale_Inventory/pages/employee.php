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
            <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold text-primary">Staff&nbsp;<a  href="emp_add.php"  type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                  <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Email</th>
                          <th>Phone</th>
<!--                          <th>Department</th>-->
<!--                          <th>Manager ID</th>-->
                          <th>Action</th>
                        </tr>
                     </thead>
                    <tbody>
                    <?php                  
                        $query = "SELECT Staff_ID, Staff_Name, Staff_Email, Staff_Phone, Password, r.Role_Name 
                                 FROM Staff s 
                                 JOIN Role r ON s.Role_ID = r.Role_ID
                                 WHERE r.Role_ID != 'AD01' and r.Role_ID != 'GM'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['Staff_ID'].'</td>';
                        echo '<td>'. $row['Staff_Name'].'</td>';
                        echo '<td>'. $row['Staff_Email'].'</td>';
                        echo '<td>'. $row['Staff_Phone'].'</td>';
//                        echo '<td>'. $row['Department'].'</td>';
//                        echo '<td>'. $row['Manager_ID'].'</td>';
                        

                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="emp_searchfrm.php?action=edit & id='.$row['Staff_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Account</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="emp_edit.php?action=edit & id='.$row['Staff_ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                            </ul>
                            </div>
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