<?php
require_once('session.php');
$session = $_SESSION["Staff_ID"];
include'../includes/connection.php';
$sql = "SELECT Role_ID FROM Staff WHERE Staff_ID = '$session'";
$res = mysqli_query($conn, $sql);
$ro = mysqli_fetch_array($res);

if($ro[0] == 'AD01'){
    header("location:Admin.php");
}elseif ($ro[0] == 'A01') {
    header("location:Acc_Exe.php");
}elseif ($ro[0] == 'A02') {
    header("location:Acc_Exe.php");
}elseif ($ro[0] == 'L01') {
    header("location:Logistics_Exe.php");
}elseif ($ro[0] == 'L02') {
    header("location:Logistics_Exe.php");
}elseif ($ro[0] == 'S01') {
    header("location:Sale_Exe.php");
}elseif ($ro[0] == 'S02') {
    header("location:Sale_Manager.php");
}else{
    header("location:login.php");
}

mysqli_close($conn);