<?php
require("../mod_configuracion/conexion.php");
require("../theme/header_inicio.php");

?>
<br />
<div class="titulo">Historial del Paciente</div><br /><br />
<?php
//BUSCA EN LOS REGISTROS DE IHISTORIALES CUAL ES EL MAXIMO NUMERO O EL ULTIMO MAYOR
$max="select max(dni_historial) as maxid from historial";
$rs=mysql_query($max,$con);
	if(mysql_num_rows($rs)){
	$codexp=mysql_result($rs,0,"maxid")+1; //SE LE SUMA 1 PARA QUE SEA EL REGISTRO CORRELATIVO 
	}else{$codexp=1;}//SINO EXISTE LE AGREGA 1 (EL PRIMERO) SOLO SE CUMPLE UNA SOLA VEZ
if (strtolower($_REQUEST["acc"])=="registrar"){// CUANDO LA ACCION SEA "registrar" ENTRA EN LA CONDICION
//VALIDACIONES DE LOS DATOS ENVIADOS
if ($_REQUEST["cedpac"]=="" or $_POST["actividad"]=="" or $_POST["tiempo"]=="" or $_POST["distancia"]==""){
	cuadro_error("Debe ingresar la actividad, tiempo, distancia del empleado");
	}else{
$sql="insert into registro(no_nomina,actividad,tiempo,distancia) values('".$_REQUEST["cedpac"]."','".$_REQUEST["actividad"]."','".$_REQUEST["tiempo"]."','".$_REQUEST["distancia"]."') ";


$habitos_per = "";
$hd = $_REQUEST["habitos"];
for($i=0; $i<=sizeof($hd); $i++){
	$habitos_per .= $hd[$i]." ";
	}
//Inserta los datos a la tabla patologia

// patologia insert into patologia values(NULL,'". $_REQUEST["cedpac"]., 'una','dos',now())
		if(mysql_query($sql,$con)){
	 cuadro_mensaje("Historial Registrado Correctamente...");
					echo "<br><br><br><br><br>";
					require("../theme/footer_inicio.php");
					exit;
				}
				 else {
				 	
				 	echo "Error: ".mysql_error();
				 	
				 }

	}
}
?>
<form name="registro" action="reg_reg.php" method="post" enctype="multipart/form-data">
<table width="600" align="center" class="tabla">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>DATOS HISTORIALES DEL EMPLEADO</h3></td>
</tr>
<tr>
	<td class="tdatos">No.Nomina</td>
	<td class="dtabla"><input type="text" name="cedpac" value="<?php echo $_REQUEST["cedpac"]; ?>" onchange="this.form.submit()" size="12" /></td>
</tr>
<?php
if($_REQUEST["cedpac"]!=""){
$result=mysql_query("select a.*,b.* from empleado a, usuario b where a.no_nomina=b.id_usuario and b.id_usuario='".quitar($_REQUEST["cedpac"])."' ",$con);
if(mysql_num_rows($result) == 1){
$id_pac=mysql_result($result,0,"id_paciente");
$id_exp=mysql_result($result,0,"dni_exp");
$foto=mysql_result($result,0,"foto");
$nombre=mysql_result($result,0,"nombre");
$apellido=mysql_result($result,0,"apellido");
$sexo=mysql_result($result,0,"sexo");if($sexo=="M"){$sexo="MASCULINO";} else{$sexo="FEMENINO";}
$nomrep=mysql_result($result,0,"nombre_representante");
$telefono=mysql_result($result,0,"telefono");
$alergico=mysql_result($result,0,"alergico");
$medact=mysql_result($result,0,"med_act");
$direccion=mysql_result($result,0,"direccion");
$email=mysql_result($result,0,"email");
$dia1=substr(mysql_result($result,0,"fec_nacimiento"),8,2);
$mes1=substr(mysql_result($result,0,"fec_nacimiento"),5,2);
$ano1=substr(mysql_result($result,0,"fec_nacimiento"),0,4);
/*******************************************************
***************** Seleccion de salas *******************
*******************************************************/

echo '
<tr>
	<td class="tdatos">Nombre</td>
	<td><input type="text" name="nombre" value='.$nombre.' size="40" readonly/></td>
</tr>
<tr>
	<td  class="tdatos">Fecha de Nacimiento</td>
	<td><input type="text" name="dia1" value='.$dia1.' size="1" readonly/>/<input type="text" name="mes1" value='.$mes1.' size="1" readonly/>/<input type="text" name="ano1" value='.$ano1.' size="2" readonly/>dia/mes/año</td>
</tr>
<tr>
	<td class="tdatos">Sexo</td>
	<td><input type="text" name="sexo" value='. $sexo.' size="15" readonly /></td>
</tr>
<tr>
	<td class="tdatos">Direccion</td>
	<td><input type="text" name="direccion" value='.$direccion.' size="40" readonly/></td>
</tr>
<tr>
	<td class="tdatos">Telefonos</td>
	<td><input type="text" name="telefono" value='.$telefono.' size="20" readonly /></td>
</tr>
<tr>
	<td class="tdatos">Email</td>
	<td><input type="text" name="alergico" value='.$email.' size="40" readonly/></td>
</tr>

     ';
	}else{
	?>
     <tr>
	<td class="cuadro_error" colspan="2" align="center">Empleado no registrado, verifique la Nomina</td>
      </tr>
	<?php
	}
}
?>

<!--<td>
	<td class="tdatos">Habitos Personales</td>
</td> -->
<tr>
	<td class="tdatos">Actividad</td>
	<td><input type="text" name="actividad" value="<?php echo $_REQUEST["actividad"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Tiempo</td>
	<td><input type="text" name="tiempo" value="<?php echo $_REQUEST["tiempo"]; ?>" size="45"></td>
</tr>
<tr>
	<td class="tdatos">Distancia</td>
	<td><input type="text" name="distancia" value="<?php echo $_REQUEST["distancia"]; ?>" size="45"></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="acc" value="Registrar"></td>
</tr>
</table>
</form>
<?php
require("../theme/footer_inicio.php");
?>
