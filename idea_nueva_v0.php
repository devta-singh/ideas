<?php //idea_nueva_v0.php

$titulo= "Nueva Idea";


$form_idea_nueva=<<<fin
<form action="idea_grabar.php">
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