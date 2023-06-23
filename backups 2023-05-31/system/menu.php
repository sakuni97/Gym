<?php 

$userrole=$_SESSION['UserRole'];

$menu="users/menu/$userrole.php";

include $menu;
?>