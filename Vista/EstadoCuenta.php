<?php
require_once('../Logica/LNBusquedaEstadoFinanciero.php');
require_once('../Logica/LNDescargaDatosFinanzas.php');
$id=$_GET['idEstudiante'];
$Ganancia=$_POST['Ganancia'];
$objLNBEF=new LNBusquedaFinanciero();
$datosEstudiante=$objLNBEF->detalleEstudiante($id);
$datosPago=$objLNBEF->detalleEstudiante2($id);
$datosPagoTotal=$objLNBEF->detalleEstudiante3($id);
$saldoOLD=$datosEstudiante['Saldo'];
$descontar=$datosPagoTotal['pagado'];
$saldoUpdate=$saldoOLD-$descontar;
$datosUpdate=$objLNBEF->actualizarSaldo($saldoUpdate,$id);
echo $saldoUpdate;
//echo $datosPagoTotal['pagado'];
//echo $Ganancia;
//echo $id;
//var_dump($datosUpdate);


$dtz = new DateTimeZone("America/Caracas");
        $dt = new DateTime("now", $dtz);
        
        $fechaActual = $dt->format("Y-m-d");
        //echo $fechaActual;

$objLNBEF=new LNDescargaFinanciero();
$datosDescargo=$objLNBEF->Descargar($id,$Ganancia,$fechaActual);


//echo "este es el id: ".$id;
//var_dump($datosEstudiante);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuentas</title>
</head>
<body>
<h1>Estado de Cuentas</h1>
<h3>Estado de Cuentas Para: </h3>

<label for="datosFinanciero">Estudiante: </label> <?= $datosEstudiante['Estudiante'];?><br>
<label for="datosFinanciero">Facultad: </label> <?= $datosEstudiante['facultad'];?><br>
<label for="datosFinanciero">Carrera: </label> <?= $datosEstudiante['carrera'];?><br>
<label for="datosFinanciero">Coste de Semestre: </label> <?= $datosEstudiante['CosteSemestre'];?><br>
<label for="datosFinanciero">Saldo: </label> <?= $datosPagoTotal['pagado'];?><br> <br>
<table border="1">
        <tr>
            <td>Pagado</td>
            <td>Fecha de Pago</td>
            <td>Tipo de Pago</td>
        </tr>
        <?php
        foreach($datosPago as $dato){
        ?>
        <tr>
        <td> <?php echo $dato['pagado']?></td>
        <td><?php echo $dato['fechaPagada']?></td>
        <td><?php echo $dato['TipoPago']?></td>
        </tr>
    <?php
    }
    ?>
    </table>

<br>
    </table>
</body>
</html>