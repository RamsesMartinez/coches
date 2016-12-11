<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Modificaci&oacute;n de Planta</div><br />
<div align="center"><br />
  <br />
  
  
  
  <?php 
if (strtolower($_REQUEST["acc"])=="modificar"){
			if($_REQUEST["giro"]!="" or $_REQUEST["pass"]!=""or $_REQUEST["pass2"]!="" or $_REQUEST["tipo"]!=""){
	if ($_REQUEST["pass"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contrase&ntilde;as introducidas no coinciden");
	}else
	{
	
	$pass = md5($_REQUEST["pass"]);
	if (@mysql_query("update planta set desc_planta='".$_REQUEST["desc_planta"]."',giro='".strtoupper(htmlentities($_REQUEST["giro"]))."',ubicacion='".strtoupper(htmlentities($_REQUEST["ubicacion"]))."',pais='".strtoupper(htmlentities($_REQUEST["pais"]))."' where id_planta='".$_REQUEST["idplanta"]."' ",$con)){
		echo"<br /><br />";
		cuadro_mensaje("Planta modificada correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br><br><br><br><br>");
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
</div>
<div id="centercontent">
  <div align="center">
    <table>
      <td>
        <form action="act_planta.php" method="post">
          <input type="hidden" name="modificacion" value="desc_planta">
          <table class="tabla">
            <tr>
              <td colspan="2" align="center">Introduzca Descripcion de la Planta</td>
		    </tr>
            <tr>
              <td><input type="text" name="desc_planta" value="<?php echo $_REQUEST["desc_planta"]; ?>" size="15"></td>
			    <td><input type="submit" value="Buscar"></td>
		    </tr>
            </table>
	    </form>    </td>
    <td>
      <form action="act_planta.php" method="post">
        <input type="hidden" name="modificacion" value="giro">
        <table class="tabla">
          <tr>
            <td colspan="2" align="center">Ingrese Giro de la Planta</td>
		    </tr>
          <tr>
            <td><input type="text" name="giro" value="<?php echo $_REQUEST["giro"]; ?>" size="15"></td>
			    <td><input type="submit" value="Buscar"></td>
		    </tr>
          </table>
	    </form>    </td>
    </table>
  </div>
</div>
<div align="center">
  <?php
if ($_REQUEST["desc_planta"]!="" or $_REQUEST["giro"]!=""){
switch ($_REQUEST["modificacion"]){
	case'desc_planta':
	$result=mysql_query("SELECT * FROM planta WHERE desc_planta='".$_REQUEST["desc_planta"]."'");
	break;
	case'giro':
	$result=mysql_query("SELECT * FROM planta WHERE giro like '%".strtoupper($_REQUEST["giro"])."%'");
	break;
	}
if (mysql_num_rows(($result))==1){

?>
</div>
<form name="usuarios" action="act_planta.php" method="post">

<input type="hidden" name="idplanta" value="<?php echo mysql_result($result,0,"id_planta");?>">
<table class="tabla" align="center" width="500">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos de la Planta</h3></td>
</tr>



<tr>
	<td class="tdatos">Descripcion Planta</td>
	<td class="dtabla"><input type="text" name="desc_planta" value="<?php echo mysql_result($result,0,"desc_planta"); ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Giro</td>
	<td class="dtabla"><input type="text" name="giro" value="<?php echo mysql_result($result,0,"giro"); ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Ubicacion</td>
	<td class="dtabla"><input type="text" name="ubicacion" value="<?php echo mysql_result($result,0,"ubicacion"); ?>" size="12" /></td>
</tr>
<tr>
	<td class="tdatos">Pais</td>
	<td class="dtabla"><input type="text" name="pais" value="<?php echo mysql_result($result,0,"pais"); ?>" size="12" /></td>
</tr>

<tr>
	<td colspan="3" align="center"><input type="submit" name="acc" value="Modificar" size="20"></td>
</tr>
</table>
</form>

<?php
	}else{
		cuadro_mensaje ("No se encontraron registros");
	}
}
?>

<?php
require("../theme/footer_inicio.php");
?>
