<?php
require_once 'db.php';
$id=isset($_POST['id']) ? (int)$_POST['id'] : 0;
$titel=isset($_POST['titel']) ? $_POST['titel'] : null;
$erledigungsgrad=isset($_POST['erledigungsgrad']) && !empty($_POST['erledigungsgrad']) ? (int)$_POST['erledigungsgrad'] : null;
$arbeitszeit=isset($_POST['arbeitszeit']) && !empty($_POST['arbeitszeit']) ? (float)$_POST['arbeitszeit'] : null;
$maxarbeitszeit=isset($_POST['maxarbeitszeit']) && !empty($_POST['maxarbeitszeit']) ? (float)$_POST['maxarbeitszeit'] : null;
$deadlein=isset($_POST['deadlein']) ? $_POST['deadlein'] : null;
if($id<=0) {
	header('Location:index.php');
	exit;
}
if(!empty($titel)) {
    $stmt=$db->prepare("UPDATE `projekt` SET `titel` = ? WHERE `projekt`.`id` = ?");
    $stmt->bind_param('si',$titel,$id);
    $stmt->execute();
}
if($erledigungsgrad !== null) {
    $stmt=$db->prepare("UPDATE `projekt` SET `erledigungsgrad` = ? WHERE `projekt`.`id` = ?");
    $stmt->bind_param('ii',$erledigungsgrad,$id);
    $stmt->execute();
}
if($arbeitszeit !== null) {
    $stmt=$db->prepare("UPDATE `projekt` SET `arbeitszeit` = ROUND(`arbeitszeit` + ?, 2) WHERE `projekt`.`id` = ?");
    $stmt->bind_param('di',$arbeitszeit,$id);
    $stmt->execute();
}
if($maxarbeitszeit !== null) {
    $stmt=$db->prepare("UPDATE `projekt` SET `maxarbeitszeit` = ? WHERE `projekt`.`id` = ?");
    $stmt->bind_param('di',$maxarbeitszeit,$id);
    $stmt->execute();
}
if($deadlein !== null) {
    $stmt=$db->prepare("UPDATE `projekt` SET `deadlein` = ? WHERE `projekt`.`id` = ?");
    $stmt->bind_param('si',$deadlein,$id);
    $stmt->execute();
}
header('Location:index.php');
exit;
?>