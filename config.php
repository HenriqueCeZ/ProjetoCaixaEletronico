<?php
	try{

			$pdo = new PDO("mysql:dbname=caixaeletronico;host=localhost","root","");

	}
	catch(PDOException $e){

		"Falha na conexão".$e->getMessege();
		exit;

	}
?>