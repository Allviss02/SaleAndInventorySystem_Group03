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
               <h4 class="m-2 font-weight-bold text-primary">Staff information</h4>
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
                          <th>Position</th>
<!--                          <th>Department</th>-->
                          <th>Manager ID</th>
                          
                          
                        </tr>
                     </thead>
                    <tbody>
                    <?php   
                    
                        $query = "SELECT Staff_ID, Staff_Name, Staff_Email, Staff_Phone, Password, s.Role_ID,s.Working, r.Role_Name 
                                 FROM Staff s 
                                 JOIN Role r ON s.Role_ID = r.Role_ID
                                 where s.Role_ID != 'GM' and s.Working != 'off' ";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['Staff_ID'].'</td>';
                        echo '<td>'. $row['Staff_Name'].'</td>';
                        echo '<td>'. $row['Staff_Email'].'</td>';
                        echo '<td>'. $row['Staff_Phone'].'</td>';
//                        echo '<td>'. $row['Department'].'</td>';
//                        echo '<td>'. $row['Manager_ID'].'</td>';
                        echo '<td>'. $row['Role_Name'].'</td>';
                        if($row['Role_ID'] == "S01"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'S02'";

                            }else if($row['Role_ID'] == "S02"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'GM'";
                            }else if($row['Role_ID'] == "L01"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'L02'";
                            }else if($row['Role_ID'] == "L02"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'GM'";
                            }else if($row['Role_ID'] == "A01"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'A02'";
                            }else if($row['Role_ID'] == "A02"){
                                $qry = "SELECT Staff_Name FROM Staff WHERE Role_ID = 'GM'";
                            }
                            $rs = mysqli_query($conn, $qry);
                            $rw = mysqli_fetch_array($rs);
                            $rw[0];
                        echo '<td>'.$rw[0].'</td>';
                      
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