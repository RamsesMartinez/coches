<?php
require("configuracion.php");
require("funciones.php");
session_start();
$_SESSION=array();

if ($_POST["usuario"]){
	$conn_bd = mysql_connect($bd_host,$bd_usuario,$bd_pass) or die("Error en la conexión a la base de datos");
	mysql_select_db($bd_base, $conn_bd);
	// $pass = md5($_POST["password"]);
	$usuario = $_POST["usuario"];
	$password = $_POST["password"];

	$sql="SELECT * FROM usuario where nombre_usuario='" . htmlentities($_POST["usuario"]) . "' and password='" . $password . "'";
	$result = mysql_query($sql,$conn_bd);


	// Codigo para testear si existen usuarios en la base de datos

	// if($result==0){
	// 	echo 'No hay usuarios';
	// 	echo $password;
	// }else{
	// 	echo 'Hay un total de ' . mysql_num_rows($result) . ' usuarios';
	// 	echo $password;

	// }

	if (mysql_num_rows($result) == 1){
		if($_SESSION["tipo"]=="usuario"){
			$_SESSION["usuario"]=mysql_result($result,0,"usuario");
			$_SESSION["password"]=mysql_result($result,0,"password");
			$_SESSION["nombre"]=mysql_result($result,0,"nombre");
			header("Location: ../mod_inicio/index_usu.php");
		}
		else{
			$_SESSION["usuario"]=mysql_result($result,0,"usuario");
			$_SESSION["password"]=mysql_result($result,0,"password");
			$_SESSION["nombre"]=mysql_result($result,0,"nombre");
			header("Location: ../mod_inicio/index.php");
		}

	}
	else {
		?>
		<script type="text/javascript">
			// Descomentar si el codigo de la linea 18 está comentado

			alert("\tUsuario o Password incorrecto \n \t Favor de verificar los datos");
			window.location = "../index.php";
		</script>
		<?php 
	}
}
?>		
<!-- Descomentar si el codigo de la linea 18 está comentado -->

<script type="text/javascript">
	window.location = "../index.php";
</script>	