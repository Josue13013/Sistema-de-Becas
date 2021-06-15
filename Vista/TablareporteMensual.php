<?php
require_once('../Logica/LNBusquedaAsignacionBecaInstitucional.php');
require_once('../Logica/LNBusquedaEstadoFinanciero.php');
$fechaInicio=$_POST['inicio'];
$fechaFin=$_POST['fin'];
$ci=$_POST['ci'];
echo $_POST['Descarga'];
if(isset($_POST['Descarga'])){
$validador=$_POST['Descarga'];
}else{
    $validador=0;
}
echo $validador;
$objLNBABI=new LNBusquedaAsignacionBecaInstitucional();
$objLNBEF=new LNBusquedaFinanciero();
$datos=$objLNBABI->mes($fechaInicio,$fechaFin, $ci);
$datosEstudiante=$objLNBABI->detalleEstudiante($ci);
$idContrato=$objLNBEF->detalleEstudiante3($ci);
$TiempoTotal=$objLNBABI->totalTime($fechaInicio,$fechaFin, $ci);
//var_dump($idContrato);
//echo "este es el id:".$idContrato['idContrato'];
$GanadoDia;
$dtz = new DateTimeZone("America/Caracas");
        $dt = new DateTime("now", $dtz);
        
        $fechaActual = $dt->format("Y-m-d");
        //echo $fechaActual;


//echo $fechaInicio;
//echo $fechaFin;
//var_dump($datos);
//echo "este es el id: ".$ci;
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
<h1>Reporte Mensual</h1>
<label for="datos">De: </label> <?= $fechaInicio;?> <br>
<label for="datos">A: </label> <?= $fechaFin;?> <br>

<label for="datos">Gestion: </label> <?= $datosEstudiante['gestion'];?> <br>
<label for="datos">Estudiante: </label> <?= $datosEstudiante['Estudiante'];?><br>
<label for="datos">Departamento: </label> <?= $datosEstudiante['Departamento'];?><br>
<label for="datos">Area: </label> <?= $datosEstudiante['Area'];?><br>
<label for="datos">Precio: </label> <?= $datosEstudiante['precio'];?> <br>
<label for="datos">Jefe de Departamento: </label> <?= $datosEstudiante['Jefe'];?><br>

    
    <table border="1">
        <tr>
            <td>Fecha</td>
            <td>HorasTrabajadas</td>
            <td>Ganado Diario</td>
        </tr>
        <?php
        foreach($datos as $dato){
        ?>
        <td><a href="ReporteDiario.php?fecha=<?php echo $dato['fecha']?>&& ci=<?php echo $ci?>"><?php echo $dato['fecha']?></a></td>
        <td><?php echo $horasLaborales=$dato['HorasTrabajadas']?></td>
        <?php
        $yourdatetime =$horasLaborales ;
        $timestamp = strtotime($yourdatetime);
        $convert=date('h.i', $timestamp);
        $precioMulti=$datosEstudiante['precio'];
        //echo $convert;
        //echo $precioMulti;
        $GananciaDia=$convert*$precioMulti;
         $GananciaDia;
        ?>
        <td><?php echo $GananciaDia?></td>
        </tr>
    <?php
    //echo $horasLaborales;
    }
    ?>
    <?php foreach($TiempoTotal as $total){
    
    ?>
    <?php  $totalHoras=$total['TotalHoras']?>
    <?php
    $Ganancia=$totalHoras*$datosEstudiante['precio'];
    $Ganancia=$Ganancia/10000;
    }
    ?>
    <label for="datos">Total Ganado: </label> <?= $Ganancia;?><label for="datos">Bs.</label><br>
    <br>
    <?php 
    if($validador=='0'){
    ?>
    <form action="../Vista/EstadoCuenta.php" name="oculto" method="POST">
<input type="hidden" value="<?php echo $idContrato['idContrato'];?>" name="idContrato" >
<input type="hidden" value="<?php echo $fechaActual;?>" name="fecha" > 
<input type="hidden" value="<?php echo $Ganancia;?>" name="ganancia" > 
<input type="submit" value="Descargar Saldo">
    <br>
    <?php
    }else{
        echo "Los datos ya fueron descargados";
        }
    ?>
    
    </table>
</body>
</html>