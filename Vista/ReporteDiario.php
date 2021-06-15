<?php
 require_once('../Logica/LNBusquedaAsignacionBecaInstitucional.php');
 $idABI=$_GET['idABI'];
 $fecha=$_GET['fecha'];
 $objLNBABI=new LNBusquedaAsignacionBecaInstitucional();
$datosdia=$objLNBABI->dia($idABI,$fecha);
$datosEstudiante=$objLNBABI->detalleEstudiante($idABI);
$fechaTraducida=$objLNBABI->fechaCastellano($fecha);
 //var_dump($datosdia);
//echo "idABI: ".$idABI;
//echo "fecha: ".$fecha;
//var_dump($datosdia);
//$fecha=$datosdia['HorasTrabajadas'];
//var_dump($fecha);
//$yourdatetime = ;
//$timestamp = strtotime($yourdatetime);
//echo date('h.i', $timestamp); // 4.04
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Dia</title>
</head>
<body>

<body>
<h1>Reporte Diario</h1>
<label for="datos">Gestion: </label> <?= $datosEstudiante['gestion'];?> <br>
<label for="datos">Estudiante: </label> <?= $datosEstudiante['Estudiante'];?><br>
<label for="datos">Departamento: </label> <?= $datosEstudiante['Departamento'];?><br>
<label for="datos">Area: </label> <?= $datosEstudiante['Area'];?><br>
<label for="datos">Precio: </label> <?= $datosEstudiante['precio'];?> <br>
<label for="datos">Jefe de Departamento: </label> <?= $datosEstudiante['Jefe'];?><br>
<label for="datos">Dia: </label> <?= $fecha;?><label for="datos">:   </label><?= $fechaTraducida;?>

    
    
    <table border="1">
        <tr>
            <td>Hora Entrada</td>
            <td>Hora Salida</td>
            <td>Horas Trabajadas</td>
        </tr>
        <?php
        foreach($datosdia as $datodia){
        ?>
        <td><?php echo $datodia['HoraEntrada']?></td>
        <td><?php echo $datodia['HoraSalida']?></td>
        <td><?php echo $horasLaborales=$datodia['HorasTrabajadas']?></td> 
        </tr>
        <br>
    <?php
         $yourdatetime =$horasLaborales ;
         $timestamp = strtotime($yourdatetime);
         $convert=date('h.i', $timestamp);
         $precioMulti=$datosEstudiante['precio'];
         //echo $convert;
         //echo $precioMulti;
         $Ganancia=$convert*$precioMulti;
         echo "Ganado: ".$Ganancia."\n";
         //echo $horasLaborales; 

    }
    ?>
    
    </table>
</body>
</html>