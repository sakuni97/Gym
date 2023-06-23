<?php
include '../../function.php';

echo $id = $_GET['comment_id'];
echo $status = $_GET['Status'];

// Prepare the query with proper quoting
$sql = "UPDATE tbl_blog_comments SET comment_status = '$status' WHERE comment_id = '$id'";

$db = dbConn();
$results = $db->query($sql);

header('location:comments.php');
?>
