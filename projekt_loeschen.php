<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id<=0) {
	header('Location:index.php');
	exit;
}
$stmt=$db->prepare("select id from projekt where id=? limit 1");
$stmt->bind_param('i',$id);
$stmt->execute();
$result=$stmt->get_result();
$projekt=$result->fetch_object();
$result->free();
if(!$projekt) {
  header('Location:index.php');
  exit;
}

$db->query("delete from projekt where id=".$id);
header('Location:index.php');
exit;
?>