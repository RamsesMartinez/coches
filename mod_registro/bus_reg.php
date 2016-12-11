<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");
?>
<br />
<div class="titulo">Consulta del Paciente</div><br /><br />
<div id="centercontent">
<div align="center">
<table>
<td>
<form action="bus_reg.php">
		<input type="hidden" name="busqueda" value="apellido">
		<table class="tabla">
		<tr>
			<td colspan="2" align="center">Introduzca Apellido</td>
		</tr>
		<tr>
			<td><input type="text" name="ape" value="<?php echo $_REQUEST["ape"]; ?>" size="20"></td>
			<td><input type="submit" value="Buscar"></td>
		</tr>
		</table>
	</form>
</td>
<td>
<form action="bus_reg.php">
		<input type="hidden" name="busqueda" value="nombre">
		<table class="tabla">
		<tr>
			<td colspan="2" align="center">Ingrese Nombre</td>
		</tr>
		<tr>
			<td><input type="text" name="nom" value="<?php echo $_REQUEST["nom"]; ?>" size="20"></td>
			<td><input type="submit" value="Buscar"></td>
		</tr>
		</table>
	</form>
</td>
<tr>
<td>
	<form action="bus_reg.php">
		<input type="hidden" name="busqueda" value="planta">
		<table class="tabla">
		<tr>
			<td colspan="2" align="center">Consulta por Planta</td>
		</tr>
		<tr>
		<td>
			<select name="planta">
			<option value="">Seleccione</option>
			<?php
				$result2=mysql_query("select * from planta",$con);
				while($row2=mysql_fetch_assoc($result2)){
					if ($row2["id_planta"]==$_REQUEST["planta"]){ $slt="selected ";}else{ $slt="";}
					echo "<option $slt value=\"".$row2["id_planta"]."\">".$row2["desc_planta"]."</option>\n";
				}
			?>
			</select>
			</td>
			<td><input type="submit" value="Buscar"></td>
		</tr>
		</table>
	</form>
	</td>
</td>

</table>
</div>
<br />
<div align="center">
<?php
if($_REQUEST["busqueda"]!=""){
switch($_REQUEST["busqueda"]){
	case'no_nomina':
	$resultado=mysql_query("select a.*,b.*,c.* from empleado a, usuario b, planta c where a.no_nomina='".quitar($_REQUEST["no_nomina"])."' and a.no_nomina=b.id_usuario and b.planta=c.id_planta ",$con);

	if(mysql_num_rows($resultado) == 1){
	$no_nomina=mysql_result($resultado,0,"no_nomina");
	$id_pac=mysql_result($resultado,0,"id_paciente");
	$id_exp=mysql_result($resultado,0,"dni_exp");
	$est_exp=mysql_result($resultado,0,"estado_exp");
	$nombre=mysql_result($resultado,0,"nombre");
	$apellido=mysql_result($resultado,0,"apellido");
	$sexo=mysql_result($resultado,0,"sexo");
	$nomrep=mysql_result($resultado,0,"nombre_representante");
	$telefono=mysql_result($resultado,0,"telefono");
	$foto=mysql_result($resultado,0,"foto");
	$planta=mysql_result($resultado,0,"desc_planta");
	$direccion=mysql_result($resultado,0,"direccion");
	$emergencia=mysql_result($resultado,0,"emergencia");
	$grusan=mysql_result($resultado,0,"grusan");
	$vih=mysql_result($resultado,0,"vih");
	$peso=mysql_result($resultado,0,"peso");
	$talla=mysql_result($resultado,0,"talla");
	$alergico=mysql_result($resultado,0,"alergico");
	$medact=mysql_result($resultado,0,"med_act");
	$enfermedad=mysql_result($resultado,0,"enf_act");
	$dia1=substr(mysql_result($resultado,0,"fec_nac"),8,2);
	$mes1=substr(mysql_result($resultado,0,"fec_nac"),5,2);
	$ano1=substr(mysql_result($resultado,0,"fec_nac"),0,4);
				
	}
	break;
	case'nombre':
	$resultado=mysql_query("select a.*,b.*,c.* from empleado a, usuario b, planta c where a.nombre like '%".strtoupper($_REQUEST["nom"])."%' and a.id_nomina=b.id_usuario and b.planta=c.id_planta order by no_nomina desc",$con);
	break;
	case'apellido':
	$resultado=mysql_query("select a.*,b.*,c.* from paciente a, expediente b, sala c where a.apellido like '%".strtoupper($_REQUEST["ape"])."%' and a.ced=b.ced_paciente and b.sala=c.id_sala order by ced desc",$con);
	break;
	case'planta':
	$resultado=mysql_query("select a.*,b.*,c.* from empleado a, usuario b, planta c where a.no_nomina=b.id_usuario and b.planta='".quitar($_REQUEST["planta"])."' and b.planta=c.id_planta order by no_nomina desc",$con);
	break;
}

if(mysql_num_rows($resultado)>0){
if($_REQUEST["busqueda"]=="no_nomina"){
?>

<form action="../mod_impresion/imp_reg.php" method="post"  target="_blank">
<br />
<table width="500" align="center"  class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>DATOS PERSONALES</h3></td>
</tr>

<tr>
	<td class="tdatos">C&eacute;dula:</td>
	<td class="dtabla">
	 <input type="hidden" name="no_nomina" value="<?php echo $no_nomina; ?>"><?php echo $no_nomina; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Foto</td>
	<td class="dtabla"><IMG SRC="<?php echo $foto; ?>" TITLE="<?php echo $nombre; ?>" WIDTH=80	HEIGHT=100></td>
</tr>

<tr>
	<td class="tdatos">Nombres:</td>
	<td class="dtabla">
	<input type="hidden" name="nombre" value="<?php echo $nombre; ?>"><?php echo $nombre; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Apellidos:</td>
	<td class="dtabla">
	<input type="hidden" name="apellido" value="<?php echo $apellido; ?>"><?php echo $apellido; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Edad:</td>
	<td class="dtabla">
	<input type="hidden" name="edad" value="<?php echo date('Y')-$ano1; ?>"><?php echo date('Y')-$ano1; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Fecha Nac:</td>
	<td class="dtabla">
	<input type="hidden" name="fech_nac" value="<?php echo $dia1; echo"/"; echo $mes1; echo"/"; echo $ano1; ?>"><?php echo $dia1; echo"/"; echo $mes1; echo"/"; echo $ano1; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Sexo:</td>
	<td class="dtabla">
	<input type="hidden" name="sexo" value="<?php if($sexo=="M"){echo"MASCULINO";} else{echo"FEMENINO";} ?>"><?php if($sexo=="M"){echo"MASCULINO";} else{echo"FEMENINO";} ?></input></td>
</tr>

<tr>
	<td class="tdatos">Sala:</td>
	<td class="dtabla">
	<input type="hidden" name="sala" value="<?php echo $sala; ?>"><?php echo $sala; ?></input></td>
</tr>

<tr>
	<td class="tdatos">Tel&eacute;fono:</td>
	<td class="dtabla">
	<input type="hidden" name="telefono" value="<?php echo $telefono; ?>"><?php echo $telefono; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Nombre del Representante:</td>
	<td class="dtabla">
	<input type="hidden" name="nomrep" value="<?php echo $nomrep; ?>"><?php echo $nomrep;?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Direcci&oacute;n:</td>
	<td class="dtabla">
	<input type="hidden" name="direccion" value="<?php echo $direccion ?>"><?php echo $direccion; ?>
	</input></tr>
</tr>

<tr>
	<td class="tdatos">Emergencia:</td>
	<td class="dtabla">
	<input type="hidden" name="emergencia" value="<?php echo $emergencia; ?>"><?php echo $emergencia; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Grupo Sanguineo:</td>
	<td class="dtabla">
	<?php 
	switch($grusan)
	{
	case("AME"):
	$grusan="A RH-";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
    case("AMA"):
    $grusan="A RH+";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("ABME"):
	$grusan="AB RH-";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("ABMA"):
	$grusan="AB RH+";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("BME"):
	$grusan="B RH-";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("BMA"):
	$grusan="B RH+";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("OME"):
	$grusan= "O RH-";
	?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	case("OMA"):
    $grusan="O RH+";
    ?>
	<input type="hidden" name="grusan" value="<?php echo $grusan; ?>"><?php echo $grusan; ?></input><?php
	break;
	}
	?></td>
</tr>

<tr>
	<td class="tdatos">VIH:</td>
	<td class="dtabla">
	<input type="hidden" name="vih" value="<?php if($vih=="S"){echo"SI";} else{echo"NO";} ?>"><?php if($vih=="S"){echo"SI";} else{echo"NO";} ?></input></td>
</tr>

<tr>
	<td class="tdatos">Alergico:</td>
	<td class="dtabla">
	<input type="hidden" name="alergico" value="<?php echo $alergico; ?>"><?php echo $alergico; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Peso:</td>
	<td class="dtabla">
	<input type="hidden" name="peso" value="<?php echo $peso; ?>"><?php echo $peso; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Talla:</td>
	<td class="dtabla">
	<input type="hidden" name="talla" value="<?php echo $talla; ?>"><?php echo $talla; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Medicamento Que toma Actualmente:</td>
	<td class="dtabla">
	<input type="hidden" name="medact" value="<?php echo $medact; ?>"><?php echo $medact; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Enfermedad Que Tiene:</td>
	<td class="dtabla">
	<input type="hidden" name="enfermedad" value="<?php echo $enfermedad; ?>"><?php echo $enfermedad; ?>
	</input></td>
</tr>

<tr>
	<td class="tdatos">Estatus de Expediente</td>
	<td class="dtabla">
	<input type="hidden" name="est" value="<?php if($est_exp=='A'){$caso='ACTIVO';}if($est_exp=='I'){$caso='INACTIVO';}if($est_exp=='0'){$caso='NINGUNO';}echo $caso; ?>"><?php if($est_exp=='A'){$caso='ACTIVO';}if($est_exp=='I'){$caso='INACTIVO';}if($est_exp=='0'){$caso='NINGUNO';}echo $caso; ?>
	</input></td>
</tr>
<?php 
			echo '<tr>
				<td colspan="2" align="center" class="cdato">
<input type="button" value="Actualizar Datos" onclick="location.href='."'".'act_est.php?no_nomina=no_nomina&no_nomina='.$no_nomina."'".'">
&nbsp; <input type="submit" name="imp"  value="" class="imprimir"></td>

				</tr>';
?>
</td>
</table>
<?php
	}else ///genera una lista de todos los resultados que encuentra en la base de datos.
	{
?>
		<table width="500" align="center" class="tabla">
		<tr>
			<td class="tdatos">no_nomina</td>
			<td class="tdatos">NOMBRES</td>
			<td class="tdatos">APELLIDOS</td>
			<td class="tdatos">EDAD</td>
			<td class="tdatos">SALA</td>			
		</tr>
<?php
		while ($row=mysql_fetch_assoc($resultado)){
			if($row["sexo"]=='M'){$sexo="MASCULINO";}else{$sexo="FEMENINO";}
			$edad=(date('Y')-(substr($row["fec_nac"],0,4)));//calcula la edad automaticamente	
			echo "<tr><td class=\"tdatos\"><a href=\"bus_reg.php?busqueda=no_nomina&no_nomina=".$row["no_nomina"]."\">".$row["no_nomina"]."</a></td><td class=\"cdato\">".$row["nombre"]."</td><td class=\"cdato\">".$row["apellido"]."</td><td class=\"cdato\">".$edad."</td><td class=\"cdato\">".$row["denominacion"]."</td>";
		$vehiculo="";
		}
	}
?>
</table>

</form>
<?php			
		}else///mensaje de error cuando no encuentra ningun registro en la base de datos
		{
			echo "<br>";
			cuadro_error("Paciente: <b>".$_REQUEST["nom"]."</b> <b>".$_REQUEST["ape"]."</b> No Registrado  <b><a href=reg_est.php target=\"_self\">Registrar?</a></b>"); ///colocar un enlace para registrar a la persona
		}
}	
echo "<br><br>";
require("../theme/footer_inicio.php");
?>
