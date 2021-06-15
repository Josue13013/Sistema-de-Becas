-- Consulta dado un departamento lista las areas
SELECT d.idDepartamento,d.nombre,a.idArea,a.nombre
FROM departamento d INNER JOIN area a
ON d.idDepartamento = a.idDepartamento
AND d.idDepartamento = 2; --2, 3, 4, 5, 6,7,8,10


-- Consulta, dada dos fecha mostrar quienes registraron sus entradas y salidas
SELECT * 
FROM registroEntradaSalida
WHERE fecha BETWEEN '2021-02-22' AND '2021-02-24';

-- Consulta para obtener la gestion actual
SELECT *
FROM gestion 
WHERE activo = 1;

-- Consulta para verificar que estudiantes estan en la gestion actual
SELECT d.nombre Departamento, a.nombre Area, 
CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre) Estudiante, 
e.idEstudiante,e.ci
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.idGestion = 5
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento;

-- Consulta para verificar si un estudiante esta trabajando en la gestion actual 
SELECT d.nombre Departamento, a.nombre Area,abi.idAsignacionBecaInstitucional,
abi.idSolicitudBecaInstitucional, 
CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre) Estudiante, 
e.idEstudiante,e.ci
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.idGestion = 5
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante 
AND e.idEstudiante = 1
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento;

-- Consulta de estudiantes que NO trabajan en la gestion actual.
SELECT d.nombre Departamento, a.nombre Area, 
CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre) Estudiante, 
e.idEstudiante,e.ci,g.idGestion,g.nombre
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.idGestion != 5
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante 
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento;

-- Verificar si estudiante ingresa en la fecha
SELECT idAsignacionBecaInstitucional,fecha,horaInicio,horaFin,totalHora 
FROM registroEntradaSalida
WHERE idAsignacionBecaInstitucional = 1 
AND fecha = '2021-02-22';

-- Verificar Entrada Salida estudiante y fecha actual
SELECT idAsignacionBecaInstitucional,fecha,horaInicio,horaFin,totalHora 
FROM registroEntradaSalida
WHERE idAsignacionBecaInstitucional = :idAsignacionBecaInstitucional 
AND fecha = :fecha 
AND horaFin is NULL;



-- Consulta para verificar que personal de diferentes departamentos estan en la gestion actual
-- pueden estar personal activos e inactivos
SELECT d.nombre Departamento, p.idPersonal,p.activo,
       CONCAT_WS(' ',p.apellidoPaterno,p.apellidoMaterno,p.primerNombre,p.segundoNombre) Personal,
	   r.nombre Rol
FROM gestion g 
INNER JOIN personalDepartamento pd 
ON g.idGestion = 5
AND g.idGestion = pd.idGestion 
INNER JOIN personal p 
ON pd.idPersonal = p.idPersonal 
INNER JOIN  rol r
ON p.idRol = r.idRol
INNER JOIN  departamento d 
ON pd.idDepartamento = d.idDepartamento;

-- Consulta para verificar si un personal trabaja en la gestion actual 
-- Personal Activo en la gestion actual
SELECT d.nombre Departamento, p.idPersonal,p.activo,
       CONCAT_WS(' ',p.apellidoPaterno,p.apellidoMaterno,p.primerNombre,p.segundoNombre) Personal,
	   r.nombre Rol
FROM gestion g 
INNER JOIN personalDepartamento pd 
ON g.idGestion = 5 -- Gestion Actual
AND g.idGestion = pd.idGestion 
INNER JOIN personal p 
ON pd.idPersonal = p.idPersonal 
AND p.idPersonal = 3 -- Personal Activo en la gestion actual
INNER JOIN  rol r
ON p.idRol = r.idRol
INNER JOIN  departamento d 
ON pd.idDepartamento = d.idDepartamento;

-- Personal Inactivo que esta en la gestion Actual
SELECT d.nombre Departamento, p.idPersonal,p.activo,
       CONCAT_WS(' ',p.apellidoPaterno,p.apellidoMaterno,p.primerNombre,p.segundoNombre) Personal,
	   r.nombre Rol
FROM gestion g 
INNER JOIN personalDepartamento pd 
ON g.idGestion = 5 -- Gestion Actual
AND g.idGestion = pd.idGestion 
INNER JOIN personal p 
ON pd.idPersonal = p.idPersonal 
AND p.idPersonal = 7 -- Personal Inactivo que no esta en la gestion Actual
INNER JOIN  rol r
ON p.idRol = r.idRol
INNER JOIN  departamento d 
ON pd.idDepartamento = d.idDepartamento;


-- Personal Inactivo que no esta en la gestion Actual
SELECT d.nombre Departamento, p.idPersonal,
       CONCAT_WS(' ',p.apellidoPaterno,p.apellidoMaterno,p.primerNombre,p.segundoNombre) Personal,
	   r.nombre Rol
FROM gestion g 
INNER JOIN personalDepartamento pd 
ON g.idGestion = 5 -- Gestion Actual
AND g.idGestion = pd.idGestion 
INNER JOIN personal p 
ON pd.idPersonal = p.idPersonal 
AND p.idPersonal = 6 -- Personal Inactivo que no esta en la gestion Actual
INNER JOIN  rol r
ON p.idRol = r.idRol
INNER JOIN  departamento d 
ON pd.idDepartamento = d.idDepartamento;


----beta de consultas para ver ultimo registro para calcular horas trabajadas
select Hour(horaFin - horaInicio), Min(horaFin - horaInicio) as Horas
from registroentradasalida
where idRegistroentradasalida=1;

SELECT TIMEDIFF('14:00:00','20:29:55');
SELECT TIMEDIFF(,);

-------consulta para ver ultimo registro y calcular horas trabajadas fijadas-----
select idRegistroentradasalida, TIMEDIFF('14:00:00','20:29:55') 
from registroentradasalida
where idregistroentradasalida=(select max(idregistroentradasalida)from registroentradasalida);

-----consulta lista para codigo(ver ultimo registro y calcular horas trabajadas)
select idRegistroentradasalida, TIMEDIFF(horaFin,horaInicio) 
from registroentradasalida
where idregistroentradasalida=(select max(idregistroentradasalida)from registroentradasalida);


-- Consulta para verificar que estudiantes estan en la gestion actual para codigo y mostrar solo nombres
SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, d.nombre Departamento, a.nombre Area 
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.idGestion = 5
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento;

--listar un estudiante con sus datos y sus entradas y salidas en determinada fecha--------------
SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
res.totalHora HorasTrabajadas
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.activo=1
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
AND abi.idAsignacionBecaInstitucional=1
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento
INNER JOIN registroEntradaSalida res
on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional;


------suma de horas----
SELECT ADDTIME('00:00:02', '00:00:02');
----consulta para informacion estudiante----
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
	    AND abi.idAsignacionBecaInstitucional=1
            INNER JOIN estudiante e
            ON abi.idEstudiante = e.idEstudiante
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


-----listar reporte mensual estudiante entradsas y salidas------
SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
res.totalHora HorasTrabajadas
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.activo=1
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
AND abi.idAsignacionBecaInstitucional=1
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento
INNER JOIN registroEntradaSalida res
on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional
and res.fecha BETWEEN '2021-03-01' and '2021-03-31';


------listar reporte del dia de un estudiante, entrada y salida-------
SELECT CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante,
d.nombre Departamento, a.nombre Area, res.fecha,res.horaInicio HoraEntrada, res.horaFin HoraSalida,
res.totalHora HorasTrabajadas
FROM gestion g
INNER JOIN solicitudBecaInstitucional sbi
ON g.idGestion = sbi.idGestion
AND g.activo=1
INNER JOIN asignacionBecaInstitucional abi 
ON sbi.idSolicitudBecaInstitucional = abi.idSolicitudBecaInstitucional
AND abi.idAsignacionBecaInstitucional=1
INNER JOIN estudiante e
ON abi.idEstudiante = e.idEstudiante
INNER JOIN area a 
ON sbi.idArea = a.idArea 
INNER JOIN departamento d 
ON a.idDepartamento = d.idDepartamento
INNER JOIN registroEntradaSalida res
on abi.idAsignacionBecaInstitucional=res.idAsignacionBecaInstitucional
and res.fecha='2021-03-01';
 
 






 