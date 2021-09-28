<?php
 $server = "localhost"; // port default 3306
    $account = "root";
    $password = "";
    $database = "SALE_INVENTORY";
    
    #2. Database connection string
    $conn = mysqli_connect($server, $account, $password, $database);
    
    #3. Test connection 
    if($conn == null):
       die("Error: connection Fails ! ");
//    else:
//        echo 'Congratulation!';
    endif;
    
    #4. Set unicode encoding 
    mysqli_set_charset($conn, "utf-8");