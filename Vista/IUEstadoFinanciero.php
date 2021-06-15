<?php
require_once('../Logica/LNBusquedaEstadoFinanciero.php');
if(isset($_GET['ci'])){
$id=$_GET['ci'];
echo $id;
$objLNBEF=new LNBusquedaFinanciero();
$datosEstudiante=$objLNBEF->detalleEstudiante($id);
$datosPago=$objLNBEF->detalleEstudiante2($id);
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
    <title>Estado de Cuentas</title>
</head>
<body>
<h1>Estado de Cuentas</h1>
<h3>Estado de Cuentas Para: </h3>

<label for="datosFinanciero">Estudiante: </label> <?= $datosEstudiante['Estudiante'];?><br>
<label for="datosFinanciero">Facultad: </label> <?= $datosEstudiante['facultad'];?><br>
<label for="datosFinanciero">Carrera: </label> <?= $datosEstudiante['carrera'];?><br>
<label for="datosFinanciero">Coste de Semestre: </label> <?= $datosEstudiante['CosteSemestre'];?><br>
<label for="datosFinanciero">Saldo: </label> <?= $datosEstudiante['saldoTotal'];?> <br>

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
    
<a href="../Vista/ReporteBecarios.php">Atras</a>   

<br>
    </table>
</body>
</html>