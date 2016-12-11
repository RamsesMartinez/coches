<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Modificaci&oacute;n del Puesto</div><br />
<div align="center"><br />
  <br />
  
  
  
  <?php 
if (strtolower($_REQUEST["acc"])=="modificar"){
			if($_REQUEST["desc_puesto"]!="" or $_REQUEST["pass"]!=""or $_REQUEST["pass2"]!="" or $_REQUEST["tipo"]!=""){
	if ($_REQUEST["pass"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contrase&ntilde;as introducidas no coinciden");
	}else
	{
	
	$pass = md5($_REQUEST["pass"]);
	if (@mysql_query("update puesto set desc_puesto='".$_REQUEST["desc_puesto"]."' where id_puesto='".$_REQUEST["idpuesto"]."' ",$con)){
		echo"<br /><br />";
		cuadro_mensaje("Puesto modificado correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br><br><br><br><br>");
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
        <form action="act_puesto.php" method="post">
          <input type="hidden" name="modificacion" value="desc_puesto">
          <table class="tabla">
            <tr>
              <td colspan="2" align="center">Introduzca Descripcion del Puesto</td>
		    </tr>
            <tr>
              <td><input type="text" name="desc_puesto" value="<?php echo $_REQUEST["desc_puesto"]; ?>" size="15"></td>
			    <td><input type="submit" value="Buscar"></td>
		    </tr>
            </table>
	    </form>    </td>
    </table>
  </div>
</div>
<div align="center">
  <?php
if ($_REQUEST["desc_puesto"]!=""){
switch ($_REQUEST["modificacion"]){
	case'desc_puesto':
	$result=mysql_query("SELECT * FROM puesto WHERE desc_puesto='".$_REQUEST["desc_puesto"]."'");
	break;
	}
if (mysql_num_rows(($result))==1){

?>
</div>
<form name="usuarios" action="act_puesto.php" method="post">

<input type="hidden" name="idpuesto" value="<?php echo mysql_result($result,0,"id_puesto");?>">
<table class="tabla" align="center" width="500">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos del Puesto</h3></td>
</tr>



<tr>
	<td class="tdatos">Descripcion Puesto</td>
	<td class="dtabla"><input type="text" name="desc_puesto" value="<?php echo mysql_result($result,0,"desc_puesto"); ?>" size="12" /></td>
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
