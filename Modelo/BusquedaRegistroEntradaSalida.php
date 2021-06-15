<?php
	require_once("../Modelo/Conexion.php");
	class BusquedaRegistroEntradaSalida
	{
		private $conexion;

		function __construct()
		{
			$this->conexion =  new Conexion();
		}
        public function verifyEntradaSalidaEstudianteFechaActual($idAsignacionBecaInstitucional,$fecha)
        {   $sql = "
                    SELECT idRegistroEntradaSalida,idAsignacionBecaInstitucional,fecha,horaInicio,horaFin,totalHora 
                    FROM registroEntradaSalida
                    WHERE idAsignacionBecaInstitucional = :idAsignacionBecaInstitucional 
                    AND fecha = :fecha
                    AND horaFin is NULL;
                   ";
            $cmd = $this->conexion->prepare($sql);
            $cmd->bindParam(':idAsignacionBecaInstitucional', $idAsignacionBecaInstitucional);
            $cmd->bindParam(':fecha', $fecha);
            $cmd->execute();
            $registroEntradaSalida = $cmd->fetch();
            return $registroEntradaSalida;
        }
        public function ultimoRegistro()
        {   $sqlRegistro = "
            select idRegistroEntradaSalida, TIMEDIFF(horaFin,horaInicio) as hora
            from registroentradasalida
            where idregistroentradasalida=(select max(idregistroentradasalida)from registroentradasalida);
                   ";
            $cmd = $this->conexion->prepare($sqlRegistro);
            $cmd->execute();
            $registroUltimo = $cmd->fetch();
            return $registroUltimo;
        }
    }//end class    
?>