<?php
require_once('../Logica/LNBusquedaAsignacionBecaInstitucional.php');
if(isset($_GET['ci'])){
$ci=$_GET['ci'];
//echo $id;
$objLNBABI=new LNBusquedaAsignacionBecaInstitucional();
$datosEstudiante=$objLNBABI->detalleEstudiante($ci);
//print_r($datosEstudiante);
//echo "hola ".$id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Estudiante</title>
</head>
<body>





<h1>Reporte Mensual</h1>
<label for="datos">Gestion: </label> <?= $datosEstudiante['gestion'];?> <br>
<label for="datos">Estudiante: </label> <?= $datosEstudiante['Estudiante'];?><br>
<label for="datos">Departamento: </label> <?= $datosEstudiante['Departamento'];?><br>
<label for="datos">Area: </label> <?= $datosEstudiante['Area'];?><br>
<label for="datos">Precio: </label> <?= $datosEstudiante['precio'];?> <br>
<label for="datos">Jefe de Departamento: </label> <?= $datosEstudiante['Jefe'];?><br>
<br>


<form action="../Vista/TablareporteMensual.php" name="parametros" method="POST">
<input type="hidden" value="<?php echo $ci;?>" name="ci" > 
<p>Reporte Mensual Inicio: </p><input type="Date" name="inicio">
<p>Reporte Mensual Fin: </p><input type="Date" name="fin"><br><br>

<input type="submit" value="Enviar">
<input type="reset" value="Cancelar">
</form>
</body>
</html>