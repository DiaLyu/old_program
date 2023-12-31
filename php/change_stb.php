<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'databs';
$user = 'root';
$password = 'root';
$current_db = $_POST['current_db'];
$tb_name = $_POST['table_name'];
$values = $_POST['values'];
$name_tb = $_POST['name_tb'];
if (isset($current_db)) {
	try {
		$dbh = new PDO("mysql:host={$host}; dbname={$current_db}", 'root', $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$name = $values[1][0];
		$type = $values[1][1];
		$length = $values[1][2];
		$atribute = $values[1][3];
		$null = $values[1][4];
		$uniq = $values[1][5];
		$autoinct = $values[1][6];
		if ($type == "INT" || $type == "VARCHAR") $length = "({$length})";
		else $length = "";
		if ($uniq == "true") {$uniq = "UNIQUE";}
		if ($uniq == "false"){ $uniq = "";}
		if ($null == "true") {$null = "NOT NULL";}
		if ($null== "false"){ $null = "";}
		if ($autoinct == "true") {$autoinct = "AUTO_INCREMENT";}
		if ($autoinct == "false") {$autoinct = "";}
		$query = "ALTER TABLE {$tb_name} CHANGE COLUMN {$name_tb} {$name} {$type}{$length} {$atribute} {$null} {$uniq} {$autoinct};";
		if($dbh->query($query))
		   echo "Выполнен запрос: ".$query;
	} catch (PDOException $e) {
		echo "Ошибка! Запрос не выполнен" . $e->getMessage();
	}
}
else {
	echo "error";
}