<?php
	require("lib.php");
	// delete file image.png
	unlink('image.png');

	$type = $_GET['type'];
	switch($type){
		case 1:
			$a = $_GET['a']; 		if ($a == null) $a = 200;
			$b = $_GET['b'];		if ($b == null) $b = 100;
			$x = $_GET['x'];		if ($x == null) $x = 0;
			$y = $_GET['y'];		if ($y == null) $y = 0;
			$zoom = $_GET['zoom']; 	if ($zoom == null) $zoom = 0;

			$obj = new Rectangle($a, $b, $zoom);
			echo "Площадь прямоугольника ($a*$b): " . $obj->getSquare() ;
			$obj->move($x, $y);
			$obj->printToScreen();

			break;
		case 2:
			$x1 = $_GET['x1']; 		if ($x1 == null) $x1 = 0;
			$y1 = $_GET['y1'];		if ($y1 == null) $y1 = 0;
			$x2 = $_GET['x2']; 		if ($x2 == null) $x2 = 0;
			$y2 = $_GET['y2'];		if ($y2 == null) $y2 = 100;
			$x3 = $_GET['x3']; 		if ($x3 == null) $x3 = 100;
			$y3 = $_GET['y3'];		if ($y3 == null) $y3 = 0;
			$x = $_GET['x'];		if ($x == null) $x = 0;
			$y = $_GET['y'];		if ($y == null) $y = 0;
			$zoom = $_GET['zoom']; 	if ($zoom == null) $zoom = 0;

			$obj = new Triangle($x1, $y1, $x2, $y2, $x3, $y3, $zoom);
			$obj->move($x, $y);
			echo "Площадь треугольника: " . $obj->getSquare();
			$obj->printToScreen();
			break;
		case 3:
			$r = $_GET['r'];		if ($r == null) $r = 100;
			$x = $_GET['x'];		if ($x == null) $x = 0;
			$y = $_GET['y'];		if ($y == null) $y = 0;
			$zoom = $_GET['zoom']; 	if ($zoom == null) $zoom = 0;

			$obj = new Circle($r, $zoom);
			echo "Площадь круга (3.14*$r*$r): " . $obj->getSquare() ;
			$obj->move($x, $y);
			$obj->printToScreen();
			break;
		default: echo "Error.";
	}

	// do height and width page optim
	$arr = getimagesize("image.png");
	$w = $arr[0] + 30;	if ($w < 1000) $w = 1000;
	$h = $arr[1] + 30;	if ($h < 600) $h = 600;
	//echo $h.' '.$w;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body style="background:url('image.png') no-repeat; height: <?=$h?>px; width: <?=$w?>px;  margin: 0px;" >

<?php
	$type = $_GET['type'];
	switch($type) {
		case 1:
			?>
			<form name="Form" method="GET" action="2.php">
				<input type="hidden" name="type" value="1">
				<input type="hidden" name="a" value="<?=$a?>">
				<input type="hidden" name="b" value="<?=$b?>">
				Положение по x:<input type="text" style="width: 35px"  maxlength="4" name="x" value="<?=$x?>">px <br>
				Положение по y:<input type="text" style="width: 35px"  maxlength="4" name="y" value="<?=$y?>">px <br>
				<input type="submit">
			</form>
			<?php
			break;
		case 2:
			?>
			<form name="Form" method="GET" action="2.php">
				<input type="hidden" name="type" value="2">
				<input type="hidden" name="x1" value="<?=$x1?>">
				<input type="hidden" name="y1" value="<?=$y1?>">
				<input type="hidden" name="x2" value="<?=$x2?>">
				<input type="hidden" name="y2" value="<?=$y2?>">
				<input type="hidden" name="x3" value="<?=$x3?>">
				<input type="hidden" name="y3" value="<?=$y3?>">
				Положение по x:<input type="text" style="width: 30px" maxlength="4" name="x" value="<?=$x?>">px <br>
				Положение по y:<input type="text" style="width: 30px" maxlength="4" name="y" value="<?=$y?>">px <br>
				<input type="submit" >
			</form>
			<?php
			break;
		case 3:
			?>
			<form name="Form" method="GET" action="2.php">
				<input type="hidden" name="type" value="3">
				<input type="hidden" name="r" value="<?=$r?>">
				Положение по x:<input type="text" style="width: 35px" maxlength="4" name="x" value="<?=$x?>">px <br>
				Положение по y:<input type="text" style="width: 35px" maxlength="4" name="y" value="<?=$y?>">px <br>
				<input type="submit" >
			</form>
			<?php
			break;
	}
?>

</body>
</html>
