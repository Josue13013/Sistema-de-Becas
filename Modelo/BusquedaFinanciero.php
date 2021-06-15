<?php
	require_once("../Modelo/Conexion2.php");
	class BusquedaFinanciero
	{
		private $conexion2;

		function __construct()
		{
			$this->conexion2 =  new Conexion2();
		}
        public function saldoEstudiante($id){
            $sqlDetalle="
z            from facultad f
            INNER JOIN carrera c
            ON f.idFacultad=c.idFacultad
            INNER JOIN contrato co
            ON c.idCarrera=co.idCarrera
            INNER JOIN saldoContrato sc
            on co.idContrato=sc.idContrato
            INNER JOIN estudiante e
            ON co.idEstudiante=e.idEstudiante
            AND e.idEstudiante=:id;
            ";
            $cmd = $this->conexion2->prepare($sqlDetalle);
            $cmd->bindParam(':id',$id);
            $cmd->execute();
            $estudiante = $cmd->fetch();  
            return $estudiante;

        }
        public function detalleEstudiante2($id){
            $sqlDetalle="
            select CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, f.nombre facultad, c.nombre carrera, co.montoTotal CosteSemestre,  sc.montoPago pagado, sc.fechaPago fechaPagada, sc.tipoPago TipoPago
            from facultad f
            INNER JOIN carrera c
            ON f.idFacultad=c.idFacultad
            INNER JOIN contrato co
            ON c.idCarrera=co.idCarrera
            INNER JOIN saldoContrato sc
            on co.idContrato=sc.idContrato
            INNER JOIN estudiante e
            ON co.idEstudiante=e.idEstudiante
            AND e.idEstudiante=:id;
            ";
            $cmd = $this->conexion2->prepare($sqlDetalle);
            $cmd->bindParam(':id',$id);
            $cmd->execute();
            $estudiante = $cmd->fetchall();  
            return $estudiante;

        }
        public function detalleEstudiante3($id){
            $sqlDetalle="
            select CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, f.nombre facultad, c.nombre carrera, co.montoTotal CosteSemestre,  SUM(sc.montoPago) pagado, sc.fechaPago fechaPagada, sc.tipoPago TipoPago
            from facultad f
            INNER JOIN carrera c
            ON f.idFacultad=c.idFacultad
            INNER JOIN contrato co
            ON c.idCarrera=co.idCarrera
            INNER JOIN saldoContrato sc
            on co.idContrato=sc.idContrato
            INNER JOIN estudiante e
            ON co.idEstudiante=e.idEstudiante
            AND e.idEstudiante=:id;
            ";
            $cmd = $this->conexion2->prepare($sqlDetalle);
            $cmd->bindParam(':id',$id);
            $cmd->execute();
            $estudiante = $cmd->fetch();  
            return $estudiante;

        }
        public function actualizarSaldo($SaldoUpdate, $id){
            $sqlUpdateSaldo="
            UPDATE saldoContrato 
            SET saldo=:saldoUpdate 
            WHERE idContrato=:id;
            ";
            $cmd = $this->conexion2->prepare($sqlUpdateSaldo);
            $cmd->bindParam(':saldoUpdate',$SaldoUpdate);
            $cmd->bindParam(':id',$id);
            $cmd->execute();
            $UpdateSaldo = $cmd->fetch();  
            return $UpdateSaldo;

        }
    }
?>