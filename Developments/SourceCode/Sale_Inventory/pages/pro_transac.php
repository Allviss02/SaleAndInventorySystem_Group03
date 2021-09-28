<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $id = $_POST['id'];
              $name = $_POST['name'];
              $packing = $_POST['packing'];
              $supplier = $_POST['supplier'];
              $origin = $_POST['origin'];
              $price = $_POST['price']; 
              $category = $_POST['cate'];
               
        
              switch($_GET['action']){
                case 'add':  
                    $query = "INSERT INTO Product
                              VALUES ('$id','$name','$packing','$supplier','$origin','$price','$category')";
                    $result = mysqli_query($conn, $query);
                    
                break;
              }
            ?>
              <script type="text/javascript">
                  alert("Your adding new product successfully !");
                  window.location = "product.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
mysqli_close($conn);
?>