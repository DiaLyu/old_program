<?php
	$db_name = $_POST['db_name'];
	$tb_name = $_POST['tb_name'];
	$key = $_POST['key'];
	$host = 'databs';
	$user = 'root';
	$password = 'root';
	try {
		$dbh = new PDO("mysql:host={$host}; dbname={$db_name}", 'root', $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$prim_key = $dbh->query("SHOW KEYS FROM {$tb_name} WHERE Key_name = 'PRIMARY'")->fetchAll()[0]["Column_name"];
		$sql_delete_row = "DELETE FROM {$tb_name} WHERE {$prim_key} = {$key}";
		if($dbh->query($sql_delete_row))
		   echo "Выполнен запрос ".$sql_delete_row;
	}  catch (PDOException $e) {
		echo "Ошибка! Запрос не выполнен" . $e->getMessage();
	}
		