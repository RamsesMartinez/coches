<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chevrolet Center</title>
	<!--*********** cambio de hojas de estilo ***************-->
    <link rel="stylesheet" href="../theme/css/style.css" type="text/css">
    <!-- ************** Menu ********************************-->
    <link rel="stylesheet" type="text/css" href="../theme/css/superfish.css" media="screen">
	<!-- Select's -->
    <script type="text/javascript" src="../theme/js/jQuery.js"></script>
	<!--   Slide   -->
	<script type="text/javascript" src="../theme/slide/slide.js"></script>
	<script type="text/javascript" src="../theme/js/funciones.js"></script>
    <!-- ************** Menu ********************************-->
    <script type="text/javascript" src="../theme/js/hoverIntent.js"></script>
	<script type="text/javascript" src="../theme/js/superfish.js"></script>
</head>
<?php  if($_SESSION["tipo"]=="ADMINISTRADOR"){$tipo = "Administrador";}elseif($_SESSION["tipo"]=="ASISTENTE"){$tipo="Asistente";}?>

<html>
<body>

<table id="header" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1">
        <div style="position:absolute; width:302px; top:30px; background:url(../theme/images/cn-bsg.gif);">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1"><img src="../theme/images/chevrolet-logod.png" alt="" width="61" height="61" class="logo"/></td>
    <td class="company_name">Chevrolet Center</td>
  </tr>
</table>
        </div>
       <div id="slogan">
       <div style="position:absolute; top:10px; left:378px; margin-left:-400px; width:681px; height:25px; font-size:25px; color:#000; font-family:'Courier New', Courier, monospace;">
  <marquee direction="left" width="100%" scrollamount="7">
    <span class="Estilo9"><?php echo "Bienvenid@ ".$tipo." ".$_SESSION["nombre"]. ". A Chevrolet Center"; ?></span>
  </marquee></div>
</div>
 <img src="../theme/images/p1.jpg" alt="" width="666" height="196"></td>
      <td class="hbg">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<!-- Menu -->
<div id="navigator">

<ul class="sf-menu">
			<li class="current">
				<a href="">Inicio</a>
				<ul>
					<li>
						<a href="../mod_inicio/index.php">Principal</a>
					</li>
					<li>
						<a href="../mod_configuracion/login.php">Salir</a>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="">Registro cliente</a>
				<ul>
					<li>
						<a href="">Administracion del Sistema</a>
						<ul>
							<li><a href="../mod_usuarios/reg_usu.php">Registrar Empleado</a></li>
							<li><a href="../mod_usuarios/act_usu.php">Configuracion de Empleado</a></li>
							<li><a href="../mod_usuarios/cam_usu.php">Cambiar Contrase&#241;a Empleados</a></li>
						</ul>
					</li>

					<li>
						<a href="">Registro Para Empleados</a>
						<ul>
							<li><a href="../mod_registro/reg_reg.php">Registrar Actividad Empleado</a></li>
							<li><a href="../mod_registro/act_reg.php">Acualizar Datos de un Empleado</a></li>
							<li><a href="../mod_registro/bus_reg.php">Ubicar Empleado</a></li>
						</ul>
					</li>


					
					
				</ul>
			<li>
				<a href="">Registro Areas</a>
				<ul>
					<li>
						<a href="">Registro Planta</a>
						<ul>
							<li><a href="../mod_areas/reg_planta.php">Registrar Planta</a></li>
							<li><a href="../mod_areas/act_planta.php">Actualizar Planta</a></li>
						</ul>
					</li>

					<li>
						<a href="">Registro Puesto</a>
						<ul>
							<li><a href="../mod_areas/reg_puesto.php">Registrar Puesto</a></li>
							<li><a href="../mod_areas/act_puesto.php">Acualizar Puesto</a></li>
						</ul>
					</li>


					<li>
						<a href="">Registro Departamento</a>
						<ul>
							<li><a href="../mod_areas/reg_depto.php">Registrar Departamento</a></li>
							<li><a href="../mod_areas/act_depto.php">Actualizar Departamento</a></li>

						</ul>
					</li>
					
					
				</ul>				



</div>
<!-- Final del menu -->

