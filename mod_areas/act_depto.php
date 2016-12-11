<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Modificaci&oacute;n del Departamento</div><br />
<div align="center"><br />
  <br />
  
  
  
  <?php 
if (strtolower($_REQUEST["acc"])=="modificar"){
			if($_REQUEST["desc_depto"]!="" or $_REQUEST["pass"]!=""or $_REQUEST["pass2"]!="" or $_REQUEST["tipo"]!=""){
	if ($_REQUEST["pass"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contrase&ntilde;as introducidas no coinciden");
	}else
	{
	
	$pass = md5($_REQUEST["pass"]);
	if (@mysql_query("update departamento set desc_depto='".$_REQUEST["desc_depto"]."' where id_depto='".$_REQUEST["iddepto"]."' ",$con)){
		echo"<br /><br />";
		cuadro_mensaje("Departamento modificado correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br><br><br><br><br>");
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
        <form action="act_depto.php" method="post">
          <input type="hidden" name="modificacion" value="desc_depto">
          <table class="tabla">
            <tr>
              <td colspan="2" align="center">Introduzca Descripcion del Departamento</td>
		    </tr>
            <tr>
              <td><input type="text" name="desc_depto" value="<?php echo $_REQUEST["desc_depto"]; ?>" size="15"></td>
			    <td><input type="submit" value="Buscar"></td>
		    </tr>
            </table>
	    </form>    </td>
    </table>
  </div>
</div>
<div align="center">
  <?php
if ($_REQUEST["desc_depto"]!=""){
switch ($_REQUEST["modificacion"]){
	case'desc_depto':
	$result=mysql_query("SELECT * FROM departamento WHERE desc_depto='".$_REQUEST["desc_depto"]."'");
	break;
	}
if (mysql_num_rows(($result))==1){

?>
</div>
<form name="usuarios" action="act_depto.php" method="post">

<input type="hidden" name="iddepto" value="<?php echo mysql_result($result,0,"id_depto");?>">
<table class="tabla" align="center" width="500">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>Datos del Departamento</h3></td>
</tr>



<tr>
	<td class="tdatos">Descripcion Departamento</td>
	<td class="dtabla"><input type="text" name="desc_depto" value="<?php echo mysql_result($result,0,"desc_depto"); ?>" size="12" /></td>
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
