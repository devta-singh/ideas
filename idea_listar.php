<?php //idea_listar.php

ini_set("display_errors", 1);
error_reporting(15);

//$sql = "SELECT * FROM IDEAS WHERE id_madre='0' ";
$sql = "SELECT * FROM IDEAS";



print "<br><a href='idea_nueva.php'>Crear Nuevo Item</a>";

print "<br>SQL: $sql";


$cnx = new Mysqli("localhost", "root", "root", "pruebas");
$res = $cnx->query($sql);
if($res){
	$html_datos=array();
	$html_datos[]="<table>";
	$html_datos[]="<tr>";
	$html_datos[]="<th>titulo</th>";
	$html_datos[]="<th>descripcion</th>";
	$html_datos[]="<th>contenido</th>";
	$html_datos[]="<th>acciones</th>";
	$html_datos[]="</tr>";
	
	while($datos = $res->fetch_assoc()){
		$titulo = $datos["titulo"];
		$descripcion = $datos["descripcion"];
		$contenido = $datos["contenido"];
		$id = $datos["id"];



		$editar="<a href='idea_editar.php?id=$id'>editar</a>";
		$anadir_hijo="<a href='idea_nueva.php?id_madre=$id'>añadir hijo</a>";
		$borrar="<a href='idea_borrar.php?id=$id'>borrar</a>";

		$html_datos[]="<tr>";
		$html_datos[]="<td>$titulo</td>";
		$html_datos[]="<td>$descripcion</td>";
		$html_datos[]="<td>$contenido</td>";
		$html_datos[]="<td>$editar $anadir_hijo $borrar</td>";
		$html_datos[]="</tr>";
	}
	
	$html_datos[]="</table>";

	$s_html_datos = implode("", $html_datos);

	$html=<<<fin
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listado de Ideas</title>
</head>
<body>
	$s_html_datos
</body>
</html>
fin;
	print $html;

}else{
	print $cnx->error;
}


?>