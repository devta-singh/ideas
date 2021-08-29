<?php //idea_editar.php

$html_titulo = "Editar Idea";

if(isset($_REQUEST["id"])){
	$id = $_REQUEST["id"];

	$cnx = new Mysqli("localhost", "root", "root", "pruebas");





	$sql = "SELECT * FROM IDEAS WHERE id = $id";
	print "<br>SQL: $sql";
	$res = $cnx->query($sql);
	$datos = $res->fetch_assoc();
	

	//$id=$datos["id"];
	$id_madre=$datos["id_madre"];
	$titulo=$datos["titulo"];
	$descripcion=$datos["descripcion"];
	$contenido=$datos["contenido"];




	$_sql = "SELECT * FROM IDEAS";
	print "<br>SQL: $_sql";

	$_res = $cnx->query($_sql);
		

	//SELECT id_madre
	$a_html_id_madre = array();
	$a_html_id_madre[]="<SELECT name='id_madre'>";

	$a_html_id_madre[]="<OPTION value='0'>Es principal (no tiene madre)</option>";

	while($_datos = $_res->fetch_assoc()){
		$_id = $_datos["id"];
		$_titulo = $_datos["titulo"];
		$_descripcion = $_datos["descripcion"];
		$_contenido = $_datos["contenido"];
		if($_id == $id_madre){
			$a_html_id_madre[]="<OPTION value='$_id' SELECTED>($_id) $_titulo</option>";
		}else{
			$a_html_id_madre[]="<OPTION value='$_id'>($_id) $_titulo</option>";
		}
		
	}
	$a_html_id_madre[]="</SELECT>";
	$select_id_madre= implode("\n", $a_html_id_madre);





	$form_idea_nueva=<<<fin
	<form action="idea_modificar.php?id=$id">
		Depende de: $select_id_madre<br>
		<input type="hidden" id="id" name="id" value="#id#">
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

	$html_contenido = $form_idea_nueva;
}else{
	$html_contenido = "No se indicó ID a editar";
}


$html=<<<fin
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>$html_titulo</title>
</head>
<body>
$html_titulo

<br><a href='idea_listar.php'>Volver al Listado</a>

$html_contenido

<br><a href='idea_listar.php'>Volver al Listado</a>
</body>
</html>
fin;

$html = str_replace("#id#", $id, $html);
$html = str_replace("#id_madre#", $id_madre, $html);
$html = str_replace("#titulo#", $titulo, $html);
$html = str_replace("#descripcion#", $descripcion, $html);
$html = str_replace("#contenido#", $contenido, $html);

if(!headers_sent()){
	header("Content-type: text/html; charset=utf8");
}
print $html;

?>