<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Registro de empleados</div><br /><br />
<?php 
if (strtolower($_REQUEST["acc"])=="registrar"){
			if($_REQUEST["nombre"]!="" or $_REQUEST["login"]!="" or $_REQUEST["pass1"]!=""or $_REQUEST["pass2"]!="" or $_REQUEST["tipo"]!="" or $_REQUEST["ced_prof"]!="" or $_REQUEST["nombre_prof"]!="" or $_REQUEST["tipo_prof"]!="" or $_REQUEST["nombree"]!="" or $_REQUEST["direccion"]!=""or $_REQUEST["telefono"]!=""or $_REQUEST["email"]!=""or $_REQUEST["sexo"]!=""or $_REQUEST["fec_nacimiento"]!=""or $_REQUEST["edo_civil"]!=""or $_REQUEST["id_planta"]!=""or $_REQUEST["id_puesto"]!=""or $_REQUEST["id_depto"]!=""){
			
	if ($_REQUEST["pass1"]!=$_REQUEST["pass2"]){
		cuadro_error("Las contraseñas introducidas no coinciden");
	}else{
	$pass = md5($_REQUEST["pass1"]);
	

	

	$sql_2 = mysql_query("insert into usuario(login,tipo,nombre,password) values('".htmlentities($_REQUEST["login"])."','".htmlentities($_REQUEST["tipo"])."','".strtoupper(htmlentities($_REQUEST["nombre"]))."','".htmlentities($pass)."') ",$con);

	$sql_1 = mysql_query("insert into empleado(nombre,direccion,telefono,email,sexo,fec_nacimiento,edo_civil,id_planta,id_puesto,id_depto) values('".strtoupper($_REQUEST["nombre"])."','".strtoupper($_REQUEST["direccion"])."','".strtoupper($_REQUEST["telefono"])."','".strtoupper($_REQUEST["email"])."','".strtoupper($_REQUEST["sexo"])."','".$_REQUEST["ano1"]."-".$_REQUEST["mes1"]."-".$_REQUEST["dia1"]."','".strtoupper($_REQUEST["edo_civil"])."','".$_REQUEST["id_planta"]."','".$_REQUEST["id_puesto"]."','".$_REQUEST["id_depto"]."') ",$con);	
		
	
	if(/*sql_1 and */sql_2)
	{
		echo"<br /><br />";
		cuadro_mensaje("Usuario Ingresado Correctamente. <b><a href=../index.php target=\"_self\"> Volver a Inicio</a></b><br><br>");
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


<form name="usuarios" action="reg_usu.php" method="post">
<table class="tabla" align="center" width="500">
<tr>
	<td colspan="2" class="tdatos" align="center"><h3>DATOS DEL USUARIO</h3></td>
</tr>
<tr>
	<td class="tdatos">Login</td>
	<td><input type="text" name="login" value="<?php echo $_REQUEST["login"]; ?>" onchange="this.form.submit()" size="45"></td>
</tr>
<?php
if ($_REQUEST["login"]!=""){
$result=mysql_query("select login from usuario where login='".quitar($_REQUEST["login"])."' ",$con);
if(mysql_num_rows($result) == 1){
		echo '
     <tr>
	<td class="cuadro_error" colspan="2" align="center">Este login pertenece a otro usuario, cambie login</td>
      </tr>
		     ';
}else{
		echo '
     <tr>
	<td class="cuadro_mensaje" colspan="2" align="center">Login disponible</td>
      </tr>
		     ';
}
}
?>
<tr>
	<td class="tdatos">Nombre:</td>
	<td><input type="text" name="nombre" value="<?php echo $_REQUEST["nombre"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Direccion:</td>
	<td><input type="text" name="direccion" value="<?php echo $_REQUEST["direccion"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Telefono:</td>
	<td><input type="text" name="telefono" value="<?php echo $_REQUEST["telefono"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Email:</td>
	<td><input type="email" name="email" value="<?php echo $_REQUEST["email"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Sexo</td>
	<td class="dtabla">
		<select name="sexo">
			<option value="">Seleccione</option>
			<option value="M" <?php if ($_REQUEST["sexo"]=="M") echo "selected" ?>>MASCULINO</option>
			<option value="F" <?php if ($_REQUEST["sexo"]=="F") echo "selected" ?>>FEMENINO</option>
		
		</select>
	</td>
</tr>
<tr>
	<td  class="tdatos">Fecha de Nacimiento</td>
	<td class="dtabla"><input type="text" name="dia1" value="<?php echo $_REQUEST["dia1"]; ?>" size="1" />/<input type="text" name="mes1" value="<?php echo $_REQUEST["mes1"]; ?>" size="1" />/<input type="text" name="ano1" value="<?php echo $_REQUEST["ano1"]; ?>" size="2" />d&iacute;a/mes/a&ntilde;o</td>
</tr>
<tr>
	<td class="tdatos">Estado civil:</td>
	<td><input type="text" name="edo_civil" value="<?php echo $_REQUEST["edo_civil"]; ?>" size="45"></td>
</tr>




<tr>
	<td class="tdatos">Planta</td>
	<td class="dtabla">
			<select name="id_planta">
			<option value="">Seleccione</option>
			<?php
				$result2=mysql_query("select * from planta",$con);
				while($row2=mysql_fetch_assoc($result2)){
					if ($row2["id_planta"]==$_REQUEST["id_planta"]){ $slt="selected ";}else{ $slt="";}
					echo "<option $slt value=\"".$row2["id_planta"]."\">".$row2["desc_planta"]."</option>\n";
				}
			?>
			</select>	
	</td>
</tr>
<tr>
	<td class="tdatos">Puesto</td>
	<td class="dtabla">
			<select name="id_puesto">
			<option value="">Seleccione</option>
			<?php
				$result2=mysql_query("select * from puesto",$con);
				while($row2=mysql_fetch_assoc($result2)){
					if ($row2["id_puesto"]==$_REQUEST["id_puesto"]){ $slt="selected ";}else{ $slt="";}
					echo "<option $slt value=\"".$row2["id_puesto"]."\">".$row2["desc_puesto"]."</option>\n";
				}
			?>
			</select>	
	</td>
</tr>
<tr>
	<td class="tdatos">Departamento</td>
	<td class="dtabla">
			<select name="id_depto">
			<option value="">Seleccione</option>
			<?php
				$result2=mysql_query("select * from departamento",$con);
				while($row2=mysql_fetch_assoc($result2)){
					if ($row2["id_depto"]==$_REQUEST["id_depto"]){ $slt="selected ";}else{ $slt="";}
					echo "<option $slt value=\"".$row2["id_depto"]."\">".$row2["desc_depto"]."</option>\n";
				}
			?>
			</select>	
	</td>
</tr>

<tr>
	<td class="tdatos">Password:</td>
	<td><input type="password" name="pass1" value="" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Repetir Password:</td>
	<td><input type="password" name="pass2" value="" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Tipo:</td>
	<td>
		<select name="tipo">
			<option value="usuario" <?php if ($tipo=="CLIENTE") echo "selected" ?>>CLIENTE</option>
		</select>
	</td>
</tr>
<!-- Add data to Table Professional -->

<tr>
	<td colspan="2" align="center"><input type="submit" name="acc" value="Registrar" size="20">
	<input name="Restablecer" type="reset" value="Limpiar" /></td>
</tr>
</table>
</form>

<br /><br />
<?php
require("../theme/footer_inicio.php");
?>
