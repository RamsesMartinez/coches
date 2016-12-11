<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Registro de plantas</div><br /><br />
<?php 
if (strtolower($_REQUEST["acc"])=="registrar"){
			if($_REQUEST["desc_planta"]!="" or $_REQUEST["giro"]!="" or $_REQUEST["ubicacion"]!=""or $_REQUEST["pais"]!="" or $_REQUEST["tipo"]!="" or $_REQUEST["ced_prof"]!="" or $_REQUEST["nombre_prof"]!="" or $_REQUEST["tipo_prof"]!="" ){
			
	if ($_REQUEST["pass1"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contraseñas introducidas no coinciden");
	}else{
	$pass = md5($_REQUEST["pass1"]);
	

	$sql_3 = mysql_query("insert into planta(desc_planta,giro,ubicacion,pais) values('".strtoupper($_REQUEST["desc_planta"])."','".strtoupper($_REQUEST["giro"])."','".strtoupper($_REQUEST["ubicacion"])."','".strtoupper($_REQUEST["pais"])."') ",$con);
	
	if(/*sql_1 and */sql_2)
	{
		echo"<br /><br />";
		cuadro_mensaje("Planta Ingresada Correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br>");
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

<form name="registro" action="reg_planta.php" method="post" enctype="multipart/form-data">
<table width="700" align="center" class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos de la Planta</h3></td>
</tr>
<tr>
	<td class="tdatos">Descripcion Planta</td>
	<td class="dtabla"><input type="text" name="desc_planta" value="<?php echo $_REQUEST["desc_planta"]; ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Giro</td>
	<td class="dtabla"><input type="text" name="giro" value="<?php echo $_REQUEST["giro"]; ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Ubicacion</td>
	<td class="dtabla"><input type="text" name="ubicacion" value="<?php echo $_REQUEST["ubicacion"]; ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Pais</td>
	<td class="dtabla"><input type="text" name="pais" value="<?php echo $_REQUEST["pais"]; ?>" size="12" /></td>
</tr>


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
