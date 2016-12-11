<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Registro de Departamento</div><br /><br />
<?php 
if (strtolower($_REQUEST["acc"])=="registrar"){
			if($_REQUEST["desc_depto"]!=""  ){
			
	if ($_REQUEST["pass1"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contraseñas introducidas no coinciden");
	}else{
	$pass = md5($_REQUEST["pass1"]);
	

	$sql_3 = mysql_query("insert into departamento(desc_depto) values('".strtoupper($_REQUEST["desc_depto"])."') ",$con);
	
	if(/*sql_1 and */sql_2)
	{
		echo"<br /><br />";
		cuadro_mensaje("Departamento Ingresado Correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br>");
		require("../theme/footer_inicio.php");
		exit;
	} else
	{
		cuadro_error(mysql_error());
	}
	}
}else
{
	cuadro_error("Debe llenar todos los campos.");
}

}
?>

<form name="registro" action="reg_depto.php" method="post" enctype="multipart/form-data">
<table width="700" align="center" class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos del Departamento</h3></td>
</tr>
<tr>
	<td class="tdatos">Descripcion Departamento</td>
	<td><input type="text" name="desc_depto" value="<?php echo $_REQUEST["desc_depto"]; ?>" onchange="this.form.submit()" size="45"></td>

</tr>
<?php
if ($_REQUEST["desc_depto"]!=""){
$result=mysql_query("select desc_depto from departamento where desc_depto='".quitar($_REQUEST["desc_depto"])."' ",$con);
if(mysql_num_rows($result) == 1){
		echo '
     <tr>
	<td class="cuadro_error" colspan="2" align="center">Este departamento ya esta creado</td>
      </tr>
		     ';
}else{
		echo '
     <tr>
	<td class="cuadro_mensaje" colspan="2" align="center">Puesto disponible</td>
      </tr>
		     ';
}
}
?>


<tr>
	<td colspan="2" align="center"><input type="submit" name="acc" value="Registrar">
	<input name="Restablecer" type="reset" value="Limpiar" /></td>
</tr>
</table>
</form>

<br /><br />
<?php
require("../theme/footer_inicio.php");
?>
