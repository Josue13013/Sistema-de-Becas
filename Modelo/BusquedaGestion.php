<?php
	require_once("../Modelo/Conexion.php");
	class BusquedaGestion
	{
		private $conexion;

		function __construct()
		{
			$this->conexion =  new Conexion();
		}
        public function gestionActiva()
        {   $datoGestion = "
            select * from gestion where activo=1;
            ";
            $cmd = $this->conexion->prepare($datoGestion);
            $cmd->execute();
            $gestion = $cmd->fetch();
            return $gestion;
        }
        public function verificarEstudianteGestion($idGestion,$idEstudiante){
            $sql="
                    SELECT d.nombre Departamento, a.nombre Area,abi.idAsignacionBecaInstitucional,
                    abi.idSolicitudBecaInstitucional, 
                    CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre) Estudiante, 
                    e.idEstudiante,e.ci
                    FROM gestion g
                    INNER JOIN solicitudBecaInstitucional sbi
                    ON g.idGestion = sbi.idGestion
                    AND g.idGestion = :idGestion
                    INNER JOIN asignacionBecaInstitucional abi 
                    ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
                    INNER JOIN estudiante e
                    ON abi.idEstudiante = e.idEstudiante 
                    AND e.idEstudiante = :idEstudiante
                    INNER JOIN area a 
                    ON sbi.idArea = a.idArea 
                    INNER JOIN departamento d 
                    ON a.idDepartamento = d.idDepartamento;
            ";
            $cmd = $this->conexion->prepare($sql);
            $cmd->bindParam(':idGestion',$idGestion);
            $cmd->bindParam(':idEstudiante',$idEstudiante);
            $cmd->execute();
            $estudiante = $cmd->fetch();  
            return $estudiante;
        }//end function
        public function listarEstudiantesBecados(){
            $sqlEstudiantes="
            SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, d.nombre Departamento, a.nombre Area, abi.idAsignacionBecaInstitucional idABI, e.ci ci
            FROM gestion g
            INNER JOIN solicitudBecaInstitucional sbi
            ON g.idGestion = sbi.idGestion
            AND g.activo=1
            INNER JOIN asignacionBecaInstitucional abi 
            ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
            INNER JOIN estudiante e
            ON abi.idEstudiante = e.idEstudiante
            INNER JOIN area a 
            ON sbi.idArea = a.idArea 
            INNER JOIN departamento d 
            ON a.idDepartamento = d.idDepartamento;
            ";
            $cmd = $this->conexion->prepare($sqlEstudiantes);
            $cmd->execute();
            $lista=$cmd->fetchAll();
            return $lista;
        }
        public function detalleEstudiante($ci){
            $sqlDetalle="
            SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, d.nombre Departamento, a.nombre Area, 
            abi.idAsignacionBecaInstitucional idABI, g.nombre as gestion, CONCAT_WS(' ',p.apellidoPaterno,p.apellidoMaterno,p.primerNombre,p.segundoNombre)  as Jefe, g.nombre as gestion,
            r.nombre as rolPersonal, pre.precio as precio
                        FROM gestion g
                        INNER JOIN solicitudBecaInstitucional sbi
                        ON g.idGestion = sbi.idGestion
                        AND g.activo=1
                    INNER JOIN precio pre
                    ON sbi.idPrecio=pre.idPrecio
                        INNER JOIN asignacionBecaInstitucional abi 
                        ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
                        INNER JOIN estudiante e
                        ON abi.idEstudiante = e.idEstudiante
                        AND e.ci=:ci
                        INNER JOIN area a 
                        ON sbi.idArea = a.idArea 
                        INNER JOIN departamento d 
                        ON a.idDepartamento = d.idDepartamento
                    INNER JOIN personalDepartamento pd
                    ON d.idDepartamento=pd.idDepartamento
                    INNER JOIN personal p
                    ON pd.idPersonal=p.idPersonal
                    INNER JOIN rol r
                    ON p.idRol=r.idRol;
            
            ";
            $cmd = $this->conexion->prepare($sqlDetalle);
            $cmd->bindParam(':ci',$ci);
            $cmd->execute();
            $datosEstudiante=$cmd->fetch();
            return $datosEstudiante;
        }

        public function mes($fechaInicio,$fechaFin,$ci){
            $sqlMes="
            SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
            d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
            res.totalHora as HorasTrabajadas  
            FROM gestion g
            INNER JOIN solicitudBecaInstitucional sbi
            ON g.idGestion = sbi.idGestion
            AND g.activo=1
            INNER JOIN asignacionBecaInstitucional abi 
            ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
            INNER JOIN estudiante e
            ON abi.idEstudiante = e.idEstudiante
            AND e.ci=:ci
            INNER JOIN area a 
            ON sbi.idArea = a.idArea 
            INNER JOIN departamento d 
            ON a.idDepartamento = d.idDepartamento
            INNER JOIN registroEntradaSalida res
            on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional
            and res.fecha BETWEEN :fechaInicio and :fechaFin;
            ";
            $cmd = $this->conexion->prepare($sqlMes);
            $cmd->bindParam(':fechaInicio',$fechaInicio);
            $cmd->bindParam(':fechaFin',$fechaFin);
            $cmd->bindParam(':ci',$ci);
            $cmd->execute();
            $reporteMes=$cmd->fetchAll();
            return $reporteMes;

        }

        public function dia($ci,$fecha){
            $sqlDia="SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
            d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
            res.totalHora HorasTrabajadas
            FROM gestion g
            INNER JOIN solicitudBecaInstitucional sbi
            ON g.idGestion = sbi.idGestion
            AND g.activo=1
            INNER JOIN asignacionBecaInstitucional abi 
            ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
            INNER JOIN estudiante e
            ON abi.idEstudiante = e.idEstudiante
            AND e.ci=:ci
            INNER JOIN area a 
            ON sbi.idArea = a.idArea 
            INNER JOIN departamento d 
            ON a.idDepartamento = d.idDepartamento
            INNER JOIN registroEntradaSalida res
            on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional
            and res.fecha=:fecha;
            ";
            $cmd = $this->conexion->prepare($sqlDia);
            $cmd->bindParam(':ci',$ci);
            $cmd->bindParam(':fecha',$fecha);
            $cmd->execute();
            $reporteDia=$cmd->fetchAll();
            return $reporteDia;

        }
        public function totalTime($fechaInicio,$fechaFin,$ci){
            $sqltotal="
            SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
            d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
            res.totalHora as HorasTrabajadas, SUM(res.totalHora) as TotalHoras 
            FROM gestion g
            INNER JOIN solicitudBecaInstitucional sbi
            ON g.idGestion = sbi.idGestion
            AND g.activo=1
            INNER JOIN asignacionBecaInstitucional abi 
            ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
            INNER JOIN estudiante e
            ON abi.idEstudiante = e.idEstudiante
            AND e.ci=:ci
            INNER JOIN area a 
            ON sbi.idArea = a.idArea 
            INNER JOIN departamento d 
            ON a.idDepartamento = d.idDepartamento
            INNER JOIN registroEntradaSalida res
            on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional
            and res.fecha BETWEEN :fechaInicio and :fechaFin;
            ";
            $cmd = $this->conexion->prepare($sqltotal);
            $cmd->bindParam(':fechaInicio',$fechaInicio);
            $cmd->bindParam(':fechaFin',$fechaFin);
            $cmd->bindParam(':ci',$ci);
            $cmd->execute();
            $reporteTotal=$cmd->fetchAll();
            return $reporteTotal;

        }
        
    }
    ?>