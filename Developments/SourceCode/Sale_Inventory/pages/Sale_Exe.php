<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';
include'../includes/sidebar_Sale.php';

                  $query = "SELECT Role_ID FROM Staff 
                    WHERE Staff_ID = '$session'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                   $Aa = $row['Role_ID'];
                   
if ($Aa!='S01'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to Login");
                      window.location = "login.php";
                  </script>
             <?php   
             
                
                }else{
                               
           
 
            ?>
          <div class="row show-grid">
            <!-- Customer ROW -->
            <div class="col-md-3">
            <!-- Customer record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Customers</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(*) FROM Customer WHERE Staff_ID = '$session'";
                        $result = mysqli_query($conn, $query);
                        if($result){
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        }
                        ?> Record(s)
                      </div>
                    </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>

         </div>
            
            
          <!-- PRODUCTS ROW -->
          <div class="col-md-3">
            <!-- Product record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                          <?php 
                          $query = "SELECT COUNT(*) FROM Product";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_array($result)) {
                              echo "$row[0]";
                            }
                          ?> Record(s)
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <!-- Order record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Order</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                        $query = "SELECT COUNT(o.OrderMaster_ID) 
                                    FROM OrderMaster o
                                    JOIN Customer c ON o.Customer_ID = c.Customer_ID
                                    WHERE Staff_ID = '$session'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "$row[0]";
                          }
                        ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            
          <!-- RECENT PRODUCTS -->
<!--                <div class="col-lg-3">
                    <div class="card shadow h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Recent Products
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                         /.panel-heading 
                        
                        <div class="panel-body">
                            <div class="list-group">
                              <?php 
                                $query = "SELECT Product_ID, Product_Name, Supplier, Origin, Selling_Price FROM Product order by Product_ID DESC LIMIT 2";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<a href='#' class='list-group-item text-gray-800'>
                                          <i class='fa fa-tasks fa-fw'></i> $row[1] --- $row[2]
                                          </a>";
                                  }
                              ?>
                            </div>
                             /.list-group 
                            <a href="product_view.php" class="btn btn-default btn-block">View All Products</a>
                        </div>-->
                        <!-- /.panel-body -->
                          </div></div></div></div></div></div></div>
          <!-- 
          <div class="col-md-3">
           <div class="col-md-12 mb-2">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><i class="fas fa-list text-danger">&nbsp;&nbsp;&nbsp;</i>Recent Products</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          $query = "SELECT Product_Name FROM Product order by Product_ID DESC LIMIT 10";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_array($result)) {
                              echo "<ul style='list-style-position: outside'>";
                              echo "<li>$row[0]</li>";
                              echo "</ul>";
                            }
                          ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div> -->
            

          </div>

<?php
                }
include'../includes/footer.php';
mysqli_close($conn);
?>