<?php 

$userrole=$_SESSION['UserRole'];
$dashboard="users/dashboard/$userrole.php";
include $dashboard;


?>