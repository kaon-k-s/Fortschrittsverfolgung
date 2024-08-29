<?php
require_once 'db.php';
$erledigungsgradstart = 0;
$arbeitszeit = 0;
$titel=isset($_POST['titel']) ? $_POST['titel'] : null;
$maxarbeitszeit=isset($_POST['maxarbeitszeit']) && !empty($_POST['maxarbeitszeit']) ? (float)$_POST['maxarbeitszeit'] : null;
$deadlein=isset($_POST['deadlein']) ? $_POST['deadlein'] : null; //correct here so data format is proccessed correctly
if(empty($titel) || $maxarbeitszeit || $deadlein ) {
	header('Location:index.php');
	exit;
}
$stmt=$db->prepare("INSERT INTO `projekt` (`id`, `titel`, `erledigungsgrad`, `arbeitszeit`, `maxarbeitszeit`, `deadlein`) 
VALUES (NULL, ?, ?, ?, ?, ?)");
$stmt->bind_param('sidds',$titel,$erledigungsgradstart, $arbeitszeit, $maxarbeitszeit, $deadlein);
$stmt->execute();
header('Location:index.php');
exit;
?>
