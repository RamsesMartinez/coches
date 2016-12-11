<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Registro de plantas</div><br /><br />
<?php 
if (strtolower($_REQUEST["acc"])=="registrar"){
			if($_REQUEST["desc_puesto"]!=""  ){
			
	if ($_REQUEST["pass1"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contraseñas introducidas no coinciden");
	}else{
	$pass = md5($_REQUEST["pass1"]);
	

	$sql_3 = mysql_query("insert into puesto(desc_puesto) values('".strtoupper($_REQUEST["desc_puesto"])."') ",$con);
	
	if(/*sql_1 and */sql_2)
	{
		echo"<br /><br />";
		cuadro_mensaje("Puesto Ingresado Correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br>");
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

<form name="registro" action="reg_puesto.php" method="post" enctype="multipart/form-data">
<table width="700" align="center" class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos del Puesto</h3></td>
</tr>
<tr>
	<td class="tdatos">Descripcion Puesto</td>
	<td><input type="text" name="desc_puesto" value="<?php echo $_REQUEST["desc_puesto"]; ?>" onchange="this.form.submit()" size="45"></td>

</tr>
<?php
if ($_REQUEST["desc_puesto"]!=""){
$result=mysql_query("select desc_puesto from puesto where desc_puesto='".quitar($_REQUEST["desc_puesto"])."' ",$con);
if(mysql_num_rows($result) == 1){
		echo '
     <tr>
	<td class="cuadro_error" colspan="2" align="center">Este puesto ya esta creado</td>
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
