<?php //idea_borrar.php

ini_set("display_errors", 1);
error_reporting(15);

$errores=0;
if(isset($_REQUEST["id"])){
	$id = trim($_REQUEST["id"]);
}else{
	$errores++;
	$error[]="ID no indicado";
	$titulo = "";
}


if($errores){
	die("Se han producido estos ($errores) Errores:<br>".implode("<br>", $error));
}

print "procesando los datos...<br>";

$sql = "DELETE FROM IDEAS WHERE id='$id'";
print "<br>SQL: $sql";


$cnx = new Mysqli("localhost", "root", "root", "pruebas");
$res = $cnx->query($sql);
if($res){
	$n = $cnx->affected_rows;
	if($n){
		//$id = $cnx->insert_id;
		print "<br>ID $id borrado -  filas afectadas: $n";	
	}else{
		print "<br>No existe ese registro (ID $id)";	
	}

	print "<br><a href='idea_listar.php'>Volver al Listado</a>";
	
}else{
	die($cnx->error);
}


?>