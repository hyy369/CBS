<!doctype html>
<html>
<body>
Submitted.
<a href="inputForm.php" class="button">Return</a>

<?php
	if ($_POST['building'] == "null"){
		$build = "null";
		$room = "null";
	}
	else{
		$b = explode(' ', $_POST['building']);
		$build = $b[0];
		$room = $b[1];
	}
	$txt = $_POST["crn"].','.$build.','.$room.','.$_POST["start"].','.$_POST["duration"].','.$_POST["days"].','.$_POST["capacity"].','.$_POST["projector"].','.$_POST["visualizer"].','.$_POST["board"].','.$_POST["outlets"];
	echo $_POST["crn"];
	$f = fopen("input.txt","a") or die("unable");
	fwrite($f, $txt . "\n");
	fclose($f);
?>

<body>
<html>
