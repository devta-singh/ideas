<?php //idea_nueva_v0.php

if(isset($_REQUEST["id_madre"])){
	$id_madre = $_REQUEST["id_madre"];
}else{
	$id_madre = 0;
}

//creamos el select con las ideas disponibles
//$sql = "SELECT * FROM IDEAS WHERE id_madre = 0";
$sql = "SELECT * FROM IDEAS WHERE id_madre = 0";


print "<br><a href='idea_listar.php'>Volver al Listado</a>";
print "<br>SQL: $sql";


$cnx = new Mysqli("localhost", "root", "root", "pruebas");
$res = $cnx->query($sql);
$a_html_id_madre = array();
$a_html_id_madre[]="<SELECT name='id_madre'>";

$a_html_id_madre[]="<OPTION value='0'>Es principal (no tiene madre)</option>";

while($datos = $res->fetch_assoc()){
	$id = $datos["id"];
	$titulo = $datos["titulo"];
	$descripcion = $datos["descripcion"];
	$contenido = $datos["contenido"];
	if($id == $id_madre){
		$a_html_id_madre[]="<OPTION value='$id' SELECTED>$titulo</option>";
	}else{
		$a_html_id_madre[]="<OPTION value='$id'>$titulo</option>";
	}
	
}
$a_html_id_madre[]="</SELECT>";
$select_id_madre= implode("\n", $a_html_id_madre);


$titulo= "Nueva Idea";


$form_idea_nueva=<<<fin
<form action="idea_grabar.php">
	Depende de: $select_id_madre<br>
	Título:<input type="text" id="titulo" name="titulo" value="#titulo#"><br>
	Descripción:<input type="text" id="descripcion" name="descripcion" value="#descripcion#"><br>
	Contenido:<input type="text" id="contenido" name="contenido" value="#contenido#"><br>
	<input type="submit" id="enviar" value="Enviar">
	<!--
	<input type="text" id="" name="" value="">
	<input type="text" id="" name="" value="">
	<input type="text" id="" name="" value="">
	-->
</form>
fin;

$html=<<<fin
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>$titulo</title>
</head>
<body>
$titulo
$form_idea_nueva
</body>
</html>
fin;

$html = str_replace("#titulo#", "", $html);
$html = str_replace("#descripcion#", "", $html);
$html = str_replace("#contenido#", "", $html);

if(!headers_sent()){
	header("Content-type: text/html; charset=utf8");
}
print $html;

?>