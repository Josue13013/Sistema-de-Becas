<?php
require_once('../Logica/LNBusquedaEstadoFinanciero.php');
require_once('../Logica/LNDescargaDatosFinanzas.php');
$id=$_POST['idContrato'];
$fechaActual=$_POST['fecha'];
$Ganancia=$_POST['ganancia'];
$ci=$_POST['ci'];
$Descarga=1;
//echo $ci;
//$objLNBEF=new LNBusquedaFinanciero();
//echo $datosPagoTotal['pagado'];
//echo $Ganancia;
//echo $id;
//var_dump($datosUpdate);


//$dtz = new DateTimeZone("America/Caracas");
        //$dt = new DateTime("now", $dtz);

        //$fechaActual = $dt->format("Y-m-d");
        //echo $fechaActual;

$objLNDEF=new LNDescargaFinanciero();
$datosDescargo=$objLNDEF->Descargar($id,$fechaActual,$Ganancia);
//var_dump($datosDescargo);
$objLNBEF=new LNBusquedaFinanciero();
$datosEstudiante=$objLNBEF->detalleEstudiante($ci);
var_dump($datosEstudiante);
$saldoOld=$datosEstudiante['saldoTotal'];
$newSaldo=$saldoOld-$Ganancia;
echo $newSaldo;
$idContrato=$datosEstudiante['idcontrato'];
//echo $idContrato;
$SaldoUpdate=$objLNBEF->actualizarSaldo($newSaldo,$id);


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
<h1>Datos Cargados</h1>
<form action="../Vista/ReporteBecarios.php" name="oculto" method="POST">
<input type="hidden" value="<?php echo $Descarga;?>" name="Descarga" > 
<input type="submit" value="regresar">

<br>
</body>
</html>