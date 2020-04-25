<!DOCTYPE html>
<html lang="en">

<head>
	<title>testTemperature</title>
	<style>td, th {
		border: 1px solid;
		text-align: center;
		padding: 0.5em;}
	</style>
</head>

<body>
	
	<?php
		require_once('Temperature.php');
		$test = new Temperature(0, "F");
		echo "<h1>Table 1</h1>";
		echo "<table style='width:30%'>";
		echo "<tr><th colspan = '5'>Fahrenheit starts at 0, increments by 10.</th></tr>";
		echo "<tr><th>Celcius</th><th>Kelvin</th><th>Fahrenheit</th><th>Boiling</th><th>Freezing</th></tr>";
		for($i = 0; $i <= 9; $i++) {
			echo "<tr><td>";
			echo $test->getCelcius();
			echo "</td><td>";
			echo $test->getKelvin();
			echo "</td><td>";
			echo $test->getFahren();
			echo "</td><td>";
			echo $test->isBoiling();
			echo "</td><td>";
			echo $test->isFreezing();
			echo "</td></tr>";
			$test->incrementTemp(10, "F");
		}
		echo "</table>";
		
		$test2 = new Temperature(15, "C");
		echo"<h1>Table 2</h1>";
		echo "<table style='width:30%'>";
		echo "<tr><th colspan = '5'>Celcius starts at 15, increments by 25.</th></tr>";
		echo "<tr><th>Celcius</th><th>Kelvin</th><th>Fahrenheit</th><th>Boiling</th><th>Freezing</th></tr>";
		for($i = 0; $i <= 9; $i++) {
			echo "<tr><td>";
			echo $test2->getCelcius();
			echo "</td><td>";
			echo $test2->getKelvin();
			echo "</td><td>";
			echo $test2->getFahren();
			echo "</td><td>";
			echo $test2->isBoiling();
			echo "</td><td>";
			echo $test2->isFreezing();
			echo "</td></tr>";
			$test2->incrementTemp(25, "C");
		}
		echo "</table>";
	?>
</body>
</html>