<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<strong>Прямоугольник:</strong>
<form name="Form" method="GET" action="2.php">
    <input type="hidden" name="type" value="1">
    Введите размер стороны по x:<input type="text" style="width: 30px" maxlength="4" name="a" value="200">px <br>
    Введите размер стороны по y:<input type="text" style="width: 30px" maxlength="4" name="b" value="100">px <br>
    Положение по x:<input type="text" style="width: 30px" maxlength="4" name="x" value="0">px <br>
    Положение по y:<input type="text" style="width: 30px" maxlength="4" name="y" value="0">px <br>
    Масштаб увеличения:<input type="text" style="width: 30px" maxlength="3" name="zoom" value="0">% <br>
    <input type="submit" >
</form> <br>

<strong>Треугольник:</strong>
<form name="Form" method="GET" action="2.php">
    <input type="hidden" name="type" value="2">
    Координаты 3 точек:<br>
    x1: <input type="text" style="width: 30px" maxlength="4" name="x1" value="0">
    y1: <input type="text" style="width: 30px" maxlength="4" name="y1" value="0"><br>
    x2: <input type="text" style="width: 30px" maxlength="4" name="x2" value="200">
    y2: <input type="text" style="width: 30px" maxlength="4" name="y2" value="0"><br>
    x3: <input type="text" style="width: 30px" maxlength="4" name="x3" value="0">
    y3: <input type="text" style="width: 30px" maxlength="4" name="y3" value="200"><br>
    Положение по x:<input type="text" style="width: 30px" maxlength="4" name="x" value="0">px <br>
    Положение по y:<input type="text" style="width: 30px" maxlength="4" name="y" value="0">px <br>
    Масштаб увеличения:<input type="text" style="width: 30px" maxlength="3" name="zoom" value="0">% <br>
    <input type="submit" >
</form> <br>

<strong>Круг:</strong>
<form name="Form" method="GET" action="2.php">
    <input type="hidden" name="type" value="3">
    Введите радиус:<input type="text" style="width: 30px" maxlength="4" name="r" value="100">px <br>
    Положение по x:<input type="text" style="width: 30px" maxlength="4" name="x" value="0">px <br>
    Положение по y:<input type="text" style="width: 30px" maxlength="4" name="y" value="0">px <br>
    Масштаб увеличения:<input type="text" style="width: 30px" maxlength="3" name="zoom" value="0">% <br>
    <input type="submit" >
</form>

<?php
    /*<?=$_SERVER['PHP_SELF']?>*/
    //onkeydown = "javascript: return ((event.keyCode>47)&&(event.keyCode<58))"
?>