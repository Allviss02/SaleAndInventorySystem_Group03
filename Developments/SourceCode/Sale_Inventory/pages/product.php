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
              <h4 class="m-2 font-weight-bold text-primary">Product&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Product ID</th>
                     <th>Name</th>
                     <th>Supplier</th>
                     <th>Selling Price</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT Product_ID, Product_Name, Packing, Supplier, Origin, Selling_Price FROM Product';
        $result = mysqli_query($conn, $query);
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['Product_ID'].'</td>';
                echo '<td>'. $row['Product_Name'].'</td>';
                echo '<td>'. $row['Supplier'].'</td>';
                echo '<td>'. number_format($row['Selling_Price']).'</td>';
                echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="pro_searchfrm.php?code='.$row['Product_ID'].'"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pro_edit.php?code='.$row['Product_ID'].'">
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

  <!-- Product Modal-->
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="pro_transac.php?action=add">
           <div class="form-group">
               <span>Product ID</span>
               <?php 
               include'../includes/connection.php';
               $query = "SELECT MAX(Product_ID) FROM Product";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $newID = ++$row[0];
                ?>
             <input class="form-control" name="id" value="<?= $newID ?>" readonly>
           </div>
           <div class="form-group">
               <span>Product Name</span>
             <input class="form-control" name="name" required>
           </div>
           <div class="form-group">
               <span>Packing</span>
               <select class="form-control"  name="packing" >
                   <option > 25kg </option>
                   <option > 20kg </option>
                   <option > 40kg </option>
               </select>
             
           </div>
           <div class="form-group">
               <span>Supplier Name</span>
             <input class="form-control" name="supplier" required>
           </div>
           <div class="form-group">
               <span>Origin</span>
             <input class="form-control" name="origin" required>
           </div>
           <div class="form-group">
               <span>Selling Price</span>
             <input  class="form-control" min="0" max="9999999" type="number" step="500" name="price" required>
           </div>
           <div class="form-group">
               <span>Product category</span>
               <select class="form-control"  name="cate" required >
                   <option > </option>
                   <option value="1"> Lactose </option>
                   <option value="2"> Whey </option>
                   <option value="3"> Sucrose </option>
                   <option value="4"> Flour </option>
               </select>
             
           </div>
           <hr>
            <button type="submit" class="btn btn-success" 
                    onclick="return confirm('Are you sure to add new product ?')"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
      <?php
      mysqli_close($conn);
      ?>
  </div>