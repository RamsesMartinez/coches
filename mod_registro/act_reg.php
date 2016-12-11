<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");
?>
<br />
<div class="titulo">Actualizaci&oacute;n Datos del Empleado</div><br /><br />
<?php
/************************************************************
****************** Eliminar Registros ***********************
************************************************************/
if(strtolower($_POST["del"]) == "eliminar"){
	
	$sqldelexp = "delete from empleado where id_nomina='".(int)$_REQUEST["cedula"]."'";
	$sqldelpac = "delete from usuario where id_usuario='".(int)$_REQUEST["cedula"]."'";
	$sqldelhis = "delete from registro where folio='".(int)$_REQUEST["cedula"]."'";
	$sqldelpat = "delete from patologia where ced='".(int)$_REQUEST["cedula"]."'";
	
	if(  mysql_query($sqldelexp, $con) && mysql_query($sqldelpac, $con) && mysql_query($sqldelhis, $con) && mysql_query($sqldelpat, $con) ){
		cuadro_mensaje("Datos Eliminados Correctamente...");
		 			echo "<br><br><br><br><br>";
					require("../theme/footer_inicio.php");
					exit;
		
		}
	
	}

/************************************************************
****************** Editar Registros ***********************
************************************************************/
if (strtolower($_REQUEST["acc"])=="guardar"){
		//validaciones 
		if($_REQUEST["nombre"]=="" or $_REQUEST["email"]=="" or $_REQUEST["edo_civil"]=="" or 
		$_REQUEST["dia1"]=="" or $_REQUEST["mes1"]=="" or $_REQUEST["ano1"]=="" or 
		$_REQUEST["sexo"]=="" or $_REQUEST["id_planta"]=="" or $_REQUEST["telefono"]=="" or 
		$_REQUEST["id_puesto"]=="" or $_REQUEST["direccion"]==""){
			cuadro_error("Debe llenar todos los campos");
		}else{
		//valida fecha de nacimiento
		if($_REQUEST["dia1"]<=0 or $_REQUEST["dia1"]>31 or $_REQUEST["mes1"]<=0 or $_REQUEST["mes1"]>12 or $_REQUEST["ano1"]<=0 or $_REQUEST["ano1"]<=1900){cuadro_error("Fecha errada, verifique.");}else{
		//Subir imagen a nuestro fichero
		$foto=quitar($_REQUEST["ant_foto"]);
		if($_FILES['userfile']['name']!=""){//comprueba que la imagen exista
		//INICIALIZACION DE VARIABLES PARA EL ARCHIVO
		//datos del arhivo
		$nombre_archivo = "fotopaciente/" . $_FILES['userfile']['name'];
		$tipo_archivo = $_FILES['userfile']['type'];
		$tamano_archivo = $_FILES['userfile']['size'];
		$nuevo_archivo= "fotopaciente/" . quitar($_REQUEST["cedula"] .'.'. substr($tipo_archivo,6,4));
		//compruebo si las características del archivo son las que deseo
		  if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 5000000))) {
		    cuadro_error("La extensión o el tamaño de los archivos no es correcta, Se permiten archivos .gif o .jpg de 5 Mb máximo");
		    if($foto!="fotopasiente/NoPicture.gif"){
		  	$nuevo_archivo=$foto;
		    }else{
			$nuevo_archivo= "fotopaciente/NoPicture.gif";
  		         }	
		  }else{
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $nombre_archivo)){
			   @unlink($foto);
			   rename($nombre_archivo,$nuevo_archivo);
   		  //  cuadro_mensaje("El archivo ha sido cargado correctamente");
  			}else{
   				    cuadro_error("Ocurrió algún error al subir el archivo. No pudo guardarse");
 			     }
		  } 
		}else{
 		 if($foto!="fotopaciente/NoPicture.gif"){
		  	$nuevo_archivo=$foto;
		  }else{
			$nuevo_archivo= "fotopaciente/NoPicture.gif";
  		       }

		}//sino hay imagen asigna una por defecto
		//donde se llevan los datos a la BD
		if($_REQUEST["apellido"]!=""){		
		mysql_query("update historial set ced_pac='".$_REQUEST["cedula"]."' where dni_historial='".$_REQUEST["id_his"]."'",$con);
		}
			$sql="update empleado set nombre='".$_REQUEST["nombre"]."',direccion='".strtoupper($_REQUEST["direccion"])."',telefono='".strtoupper($_REQUEST["telefono"])."',,email='".strtoupper($_REQUEST["email"])."',sexo='".$_REQUEST["sexo"]."',fec_nac='".$_REQUEST["ano1"]."-".$_REQUEST["mes1"]."-".$_REQUEST["dia1"]."',edo_civil='".strtoupper($_REQUEST["edo_civil"])."',id_planta='".$_REQUEST["id_planta"]."',id_puesto='".$_REQUEST["id_puesto"]."',id_depto='".$_REQUEST["id_depto"]."' where id_nomina='".$_REQUEST["id_nomina"]."'";
			if(mysql_query($sql,$con)){
				if(mysql_query($sql2,$con)){
					cuadro_mensaje("Empleado Actualizad@ Correctamente...");
					 echo "<br><br><br><br><br>";
					require("../theme/footer_inicio.php");
					exit;
				}else{
				cuadro_error(mysql_error());//emite un mensaje de error de la BD sino se realizo la operacion
				 echo "<br><br><br><br><br>";
				require("../footer_inicio.php");
					exit;
				}
			}else{
				cuadro_error(mysql_error());
				}
		//////////////
		}
		}
}
?>
<form action="act_reg.php" method="post">
<table align="center" class="tabla">
<tr>
	<td colspan="2" align="center">Ingrese N&ordm; de Nomina del empleado</td>
	<tr>
	<td><input name="cedula1" type="text" value="" size="20"></td>
	<td><input type="submit" value="Buscar"></td>
	</tr>
</tr>
</table>
</form>
<?php
//busqueda en la base de datos
if($_REQUEST["cedula1"]!=""){
$result=mysql_query("select a.*,b.* from empleado a, usuario b where a.no_nomina='".quitar($_REQUEST["cedula1"])."' and a.no_nomina=b.id_usuario",$con);	
if(mysql_num_rows($result) == 1){
$id_nomina=mysql_result($result,0,"id_nomina");
$id_exp=mysql_result($result,0,"dni_exp");
$foto=mysql_result($result,0,"foto");
$nombre=mysql_result($result,0,"nombre");
$apellido=mysql_result($result,0,"apellido");
$sexo=mysql_result($result,0,"sexo");if($sexo=="M"){$sexo="MASCULINO";} else{$sexo="FEMENINO";}
$edo_civil=mysql_result($result,0,"edo_civil");
$telefono=mysql_result($result,0,"telefono");
$alergico=mysql_result($result,0,"alergico");
$medact=mysql_result($result,0,"med_act");
$direccion=mysql_result($result,0,"direccion");
$email=mysql_result($result,0,"email");
$dia1=substr(mysql_result($result,0,"fec_nacimiento"),8,2);
$mes1=substr(mysql_result($result,0,"fec_nacimiento"),5,2);
$ano1=substr(mysql_result($result,0,"fec_nacimiento"),0,4);
?>
<form name="registro" action="act_reg.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="ant_foto" value="<?php echo $foto;?>">
<input type="hidden" name="id_pac" value="<?php echo $id_pac;?>">
<input type="hidden" name="id_exp" value="<?php echo $id_exp;?>">
<?php $r=mysql_query("select dni_historial from historial where ced_pac='".$cedula."'",$con);
if(mysql_num_rows($r) == 1){echo '
					<input type="hidden" name="id_his" value="<?php echo mysql_result($result,0,"dni_historial")';}?>
				
<br>
<table width="650" align="center" class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>DATOS PERSONALES DEL EMPLEADO</h3></td>
</tr>

















<tr>
	<td class="tdatos">Nombre:</td>
	<td><input type="text" name="nombre" value="<?php echo $nombre; ?>" size="40" /></td>	
</tr>
<tr>
	<td class="tdatos">Direccion:</td>
	<td><input type="text" name="direccion" value="<?php echo $direccion; ?>" size="40" /></td>	
</tr>
<tr>
	<td class="tdatos">Telefono:</td>
	<td><input type="text" name="telefono" value="<?php echo $telefono; ?>" size="40" /></td>	
</tr>
<tr>
	<td class="tdatos">Email:</td>
	<td><input type="text" name="email" value="<?php echo $email; ?>" size="40" /></td>	
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
	<td><input type="text" name="dia1" value="<?php echo $dia1; ?>" size="1" />/<input type="text" name="mes1" value="<?php echo $mes1; ?>" size="1" />/<input type="text" name="ano1" value="<?php echo $ano1; ?>" size="2" />d&iacute;a/mes/a&ntilde;o</td>
</tr>
<tr>
	<td class="tdatos">Estado civil:</td>
	<td><input type="text" name="estado_civil" value="<?php echo $edo_civil; ?>" size="40" /></td>	
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
	<td colspan="2" align="center"><input type="submit" name="acc" value="Guardar">    
	&nbsp; 
	<input type="submit" name="del" value="Eliminar" onclick="confirmation();"></td>
</tr>
</table>
</form>
<?php
}else{
	echo "<br>";
	cuadro_error("Paciente No Encontrado <b><a href=reg_est.php  target=\"_self\">    Ir a Registrar</a></b>");	
}
}
?>

<?php
 echo "<br><br><br><br><br>";
require("../theme/footer_inicio.php");
?>

