<?php
header('Content-Type: text/html; charset=UTF-8');
require_once('../Logica/LNBusquedaAsignacionBecaInstitucional.php');
require_once('../Logica/LNBusquedaGestion.php');
$objLNEstudiantesLista=new LNBusquedaAsignacionBecaInstitucional();
$listaEstudiantes=$objLNEstudiantesLista->listarEstudiantesBecados();
$objgestionActiva=new LNBusquedaGestion();
$gestionActiva=$objgestionActiva->gestionActiva();
//var_dump($listaEstudiantes);
//Iniciar una nueva sesión o reanudar la existente.
session_start();
//Si existe la sesión "cliente"..., la guardamos en una variable.
if (isset($_SESSION['usuario'])){
    $user=$_SESSION['usuario'];
    if(isset($_SESSION['contrasenia'])){
        $pass=$_SESSION['contrasenia'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Estudiantes</title>
</head>
<body>
<h1>Lista de Becarios</h1>
    
    <h3>Gestion: </h3>
    <?php
    echo $gestionActiva['nombre'];
    ?>
    <br>
    
    <table border="1">
        <tr>
            <td>Estudiante</td>
            <td>Departamento</td>
            <td>Area</td>
            <td>Reporte</td>
            <td>Estado de Cuentas</td>
        </tr>
        <?php
        foreach($listaEstudiantes as $lista){
        ?>
        <tr>
        <td> <?php echo $lista['Estudiante']?></td>
        <td><?php echo $lista['Departamento']?></td>
        <td><?php echo $lista['Area']?></td>
        <td><a href="ReporteMensual.php?idABI=<?php echo $lista['idABI']?>">Mensual</a></td>
        <td><a href="EstadoCuenta.php?idEstudiante=<?php echo $lista['idEstudiante']?>">Ver</a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</body>
</html>
<?php
}}else{
	header('Location: ../salirPersonal.php');//Aqui lo redireccionas al lugar que quieras.
		die() ;
		
	   }
   ?>