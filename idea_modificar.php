<?php //idea_modificar.php

ini_set("display_errors", 1);
error_reporting(15);

$errores=0;
if(isset($_REQUEST["id"])){
	$id = trim($_REQUEST["id"]);
}else{
	$errores++;
	$error[]="id no indicado";
	$id = "";
}


if(isset($_REQUEST["titulo"])){
	$titulo = trim($_REQUEST["titulo"]);
}else{
	$errores++;
	$error[]="Titulo no indicado";
	$titulo = "";
}

if(isset($_REQUEST["descripcion"])){
	$descripcion = trim($_REQUEST["descripcion"]);
}else{
	$errores++;
	$error[]="descripcion no indicado";
	$descripcion = "";
}

if(isset($_REQUEST["contenido"])){
	$contenido = trim($_REQUEST["contenido"]);
}else{
	$errores++;
	$error[]="contenido no indicado";
	$contenido = "";
}

if($errores){
	die("Se han producido estos ($errores) Errores:<br>".implode("<br>", $error));
}

print "procesando los datos...<br>";

$s_datos_a_leer = "titulo,descripcion,contenido";
$a_datos_a_leer = explode(",", $s_datos_a_leer);
foreach($a_datos_a_leer as $c => $dato){
	
	$valor = $_REQUEST[$dato];
	print "Dato ($dato)= $valor<br>";

	$sql_datos[]= "$dato='$valor'";
}

$a_sql_datos = implode(", ", $sql_datos);

$sql = "UPDATE IDEAS SET id_madre='0', ".$a_sql_datos." WHERE id='$id'";

print "<br>SQL: $sql";


$cnx = new Mysqli("localhost", "root", "root", "pruebas");
$res = $cnx->query($sql);
if($res){
	//$id = $cnx->insert_id;
	$n = $cnx->affected_rows;

	print "<br>Modificando registro (ID $id)";

	print "<br>Modificadas ($n) filas";

	
	print "<br><a href='idea_listar.php'>Volver al Listado</a>";
}else{
	print $cnx->error;
}


?>