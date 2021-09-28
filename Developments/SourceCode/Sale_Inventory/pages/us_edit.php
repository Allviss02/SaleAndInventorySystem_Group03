<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';

           
            
?>
<div class="card shadow mb-4">
            
            <div class="card-body">
            <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Staff ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Phone</th>
                       
                   </tr>
               </thead>
          <tbody>

<?php                  
    $q = $_GET['q'];

    $query = "SELECT Staff_ID,Staff_Name,Staff_Email,Staff_Phone,Password,e.Role_ID,e.Role_Name
        FROM  `Staff` s
        JOIN `Role` e ON s.Role_ID = e.Role_ID
              WHERE e.Role_ID='$q'";
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['Staff_ID']. '</td>';
                echo '<td>'. $row['Staff_Name']. '</td>';
                echo '<td>'. $row['Staff_Email'].'</td>';
                echo '<td>'. $row['Staff_Phone'].'</td>';
                     
                echo '</tr> ';
                        }

?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
<?php
mysqli_close($conn);
