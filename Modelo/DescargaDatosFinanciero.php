<?php
	require_once("../Modelo/Conexion2.php");
	class DescargaDatosFinanciero
	{
		private $conexion2;

		function __construct()
		{
			$this->conexion2 =  new Conexion2();
		}
        public function Descargo($id,$Ganancia,$fechaActual){
            $sqlGanancia="
            INSERT INTO saldoContrato (idContrato,fechaPago,montoPago,tipoPago)
            VALUES(:id, :fechaActual, :ganancia, 'BecaConvenio');
            ";
            $cmd = $this->conexion2->prepare($sqlGanancia);
            $cmd->bindParam(':id',$id);
            $cmd->bindParam(':fechaActual',$fechaActual);
            $cmd->bindParam(':ganancia',$Ganancia);
            $cmd->execute();
            $SaldoUpdate = $cmd->fetch();  
            return $SaldoUpdate;

        }
    }
?>