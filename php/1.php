<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>

<?php
	echo "TASK WITHOUT OOP";

	echo "<br><br>TASK 1<br>";
	// find squares and sum of squares
	function fun1($n=1) {
		echo "&nbsp&nbsp&nbsp&nbsp&nbsp n = $n: ";
		$res = 0;
		if ($n < 1) echo "Error. Number is not natural or not number.<br>";
		else {
			for ($i=1; $i <= $n; $i++) {
				$tmp = $i*$i;
				if ($i+1 < $n) echo $tmp.' + ';
				else echo $tmp.' = ';
				$res += $tmp;
			}
			echo $res.'<br>';
		}
	}
?>

<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
	Введите натуральное число:<input type="text" name="n">
	<input type="submit">
</form>

<?php
	if ($_GET['n']) fun1($_GET['n']);
	//fun1(-1);	fun1("t9");		fun1("9f"); 		fun1();
	//fun1(10);	fun1(22);


	echo "<br>TASK 2<br>";
	// create abbreviated version FIO
	function fun2($fio) {
		if (!$fio) 	return;

		$fio = preg_replace('/\s+/', ' ',$fio); 	$fio = trim($fio);
		$words = explode(" ", $fio);

		$f = $words[0];
		$name = mb_substr($words[1],0,1,"utf8");
		$o =  mb_substr($words[2],0,1,"utf8");

		if ( !($f and $name and $o) ) {
			echo 'Error. Input 3 words separated by space<br>';
			return;
		}

		echo '&nbsp&nbsp&nbsp&nbsp&nbsp' . $fio ." => ";
		echo $f . ' ' . $name . '.' . $o . '.<br>';
	}
?>

<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
	Введите ФИО:<input type="text" name="fio">
	<input type="submit">
</form>


<?php
	if ($_GET['fio']) fun2($_GET['fio']);
	//fun2("Ivanov Ivan Ivanovich");
	//fun2("  Petrov  Ivan     Ivanovich   ");
	//fun2("Иванов Иван Петрович");
	//fun2(" Петров  Николай  Васильевич ");


    echo "<br>TASK 3<br>";
	// find multiply elements with paired indices and elements with not paired indices
    function fun3($n) {
        for ($i=0; $i < $n; $i++)
            $arr[$i] = mt_rand(1,100);

		if (!count($arr)) { echo 'Error. Input number!<br>'; return; }
       	echo "&nbsp&nbsp&nbsp&nbsp&nbsp generated array({$n}): " . implode(", ", $arr) . '<br>' ;

        $res = 1;
        for ($i=0; $i < $n; $i++)
            if( $arr[$i] > 0 && $i % 2 == 0) $res *= $arr[$i];

        echo "&nbsp&nbsp&nbsp&nbsp&nbsp multiply elements with paired indices: " . $res . '<br>';
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp elements with not paired indices: ";
        for ($i=0; $i < $n; $i++)
            if( $arr[$i] > 0 && $i % 2 == 1) echo $arr[$i] . '  ';
        echo '<br>';
    }
?>

<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
	Введите размер массива:<input type="text" name="num">
	<input type="submit">
</form>

<?php
	if ($_GET['num']) fun3($_GET['num']);
    //fun3(mt_rand(1,20));
    //fun3(mt_rand(1,30));


    echo "<br>TASK 4<br>";
    //$cards["шестёрка"] = 6;
	// find card by number
    function fun4($n) {
        $cards = array (
            'шестёрка' => 6,   'семёрка' => 7,        'восьмёрка' => 8,
            'девятка' => 9,    'десятка' => 10,       'валет' => 11,
            'дама' => 12,      'король' => 13,        'туз' => 14
        );
        foreach($cards as $key=>$value)
            if ($value == $n) {
                echo "&nbsp&nbsp&nbsp&nbsp&nbsp $n = > " . $key . '<br>';
                return;
            }
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp $n = > not found<br>" ;
    }
?>
	<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
		Введите номер карты:<input type="text" name="card">
		<input type="submit">
	</form>
<?php
    //fun4('семёрка');    fun4(5);
    //fun4(10);           fun4(13);     fun4(15);
	if ($_GET['card']) fun4($_GET['card']);