<?php

session_start();

// 2. Unset all the session variables
unset($_SESSION['Staff_ID']);
unset($_SESSION['Staff_Name']);
unset($_SESSION['Staff_Email']);
unset($_SESSION['Staff_Phone']);
//unset($_SESSION['Department']);
//unset($_SESSION['Manager_ID']);
//unset($_SESSION['Password']);
unset($_SESSION['Role_ID']);
//unset($_SESSION['Role']);
session_destroy();
header("location:login.php");

?>
