<?php
$db_name = $_POST['db_name'];
$tb_name = $_POST['tb_name'];
$values = $_POST['values'];
$prim_key = $_POST['prim_key'];
$name_prim_k = $_POST['name_prim_k'];
$host = 'databs';
$user = 'root';
$password = 'root';
try {
	$dbh = new PDO("mysql:host={$host}; dbname={$db_name}", 'root', $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$name_columns = $dbh->query("SHOW COLUMNS FROM {$tb_name};")->fetchAll();
	$update_table = "UPDATE {$tb_name} SET ";
	$index = 0;
	foreach ($name_columns as $value) {
		$update_table .= "{$value["Field"]} = \"{$values[$index]}\", ";
		$index++;
	}
	$update_table = substr($update_table, 0, strlen($update_table)-2);
	$update_table .= " WHERE {$name_prim_k}={$prim_key};";
	if($dbh->query($update_table))
	  echo "Выполнен запрос: ". $update_table;
} catch (PDOException $e) {
	echo "Ошибка! Строка не обновлена. " . $e->getMessage();
}