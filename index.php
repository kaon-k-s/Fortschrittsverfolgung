<?php
require_once 'db.php';
$projekte=array();
$result=$db->query("SELECT * FROM `projekt`");
while($p=$result->fetch_object()){
  $projekte[]=$p;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Projekte - Fortschrittsverfolgung</title>
  <style>
    .warning { color: red; }
  </style>
</head>
<body style="background-color: skyblue;">
<h1>Projekte - Liste</h1>
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
	  <th>Titel</th>
    <th>Erledigungsgrad</th>
    <th>Arbeitszeit</th>
    <th>Maximale Arbeitszeit</th>
    <th>Deadlein</th>
    <th></th>
	  <th></th>
  </tr>
<?php
foreach($projekte as $p) {
?>
  <tr>
	  <td><?= $p->titel ?></td>
    <td><?= $p->erledigungsgrad ?>%</td>
    <td><?= $p->arbeitszeit ?>Std</td>
    <?php
    if ($p->arbeitszeit > $p->maxarbeitszeit) {
      echo '<td class="warning">' . $p->maxarbeitszeit . 'Std</td>';
    } else {
      echo '<td>' . $p->maxarbeitszeit . 'Std</td>';
    }
    ?>
    <?php
    $current_date = date('Y-m-d');
    if ($current_date > $p->deadlein) {
      echo '<td class="warning">' . $p->deadlein . '</td>';
    } else {
      echo '<td>' . $p->deadlein . '</td>';
    }
    ?>
    <td><a href="bearbeiten_formular.php?id=<?= $p->id ?>">Bearbeiten</a></td>
	  <td><a href="projekt_loeschen.php?id=<?= $p->id ?>">Löschen</a></td>
  </tr>
<?php
}
?>
</table>
<br />
<form action="projekt_hinzufuegen.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<input type="text" name="titel" required />
  <input type="number" name="maxarbeitszeit" required />
  <input type="date" name="deadlein" required />
	<input type="submit" value="Hinzufügen" required />
</form>
</body>
</html>




