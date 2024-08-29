<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id>=0) {
	$stmt=$db->prepare("SELECT * FROM `projekt` where id=? limit 1");
	$stmt->bind_param('i',$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$projekt=$result->fetch_object();
	$result->free();
	if(!$projekt) {
	  header('Location:index.php');
	  exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Projekt - Bearbeiten</title>
</head>
<body style="background-color: skyblue;">
<h1>Projekt - Bearbeiten</h1>
<form action="projekt_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
  	<input type="hidden" name="id" value="<?= $id ?>" />
	<label>
		Titel: 
		<input type="text" name="titel" value="<?= htmlentities($projekt->titel,ENT_COMPAT) ?>" />
	</label>
	<label>
		Erledigungsgrad: 
  		<input type="number" name="erledigungsgrad"value="<?= $projekt->erledigungsgrad ?>" />
	</label>
	<label>
		Gesamte Arbeitszeit: 
		<?= $projekt->arbeitszeit ?> <input type="number" name="arbeitszeit" placeholder="Mehr Stunden hinzufügen"/>
	</label>
	<label>
		Maximale Arbeitszeit:
  		<input type="number" name="maxarbeitszeit"value="<?= $projekt->maxarbeitszeit ?>" />
	</label>
	<label>
		Deadlein:
		<input type="date" name="deadlein" value="<?= $projekt->deadlein ?>" />
	</label>
	<input type="submit" value="Speichern" />
</form>
</body>
</html>

