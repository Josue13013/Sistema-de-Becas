----consulta para devolver todos los datos de un estudiante--------
select CONCAT_WS(' ',e.apellidoPaterno,e.apellidoMaterno,e.primerNombre,e.segundoNombre)  as Estudiante, f.nombre facultad, c.nombre carrera, co.montoTotal CosteSemestre,  sc.montoPago pagado, sc.fechaPago fechaPagada, sc.tipoPago TipoPago
from facultad f
INNER JOIN carrera c
ON f.idFacultad=c.idFacultad
INNER JOIN contrato co
ON c.idCarrera=co.idCarrera
INNER JOIN saldoContrato sc
on co.idContrato=sc.idContrato
INNER JOIN estudiante e
ON co.idEstudiante=e.idEstudiante;


--consulta para ver estado de cuentas de un determinado estudiante-----
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
AND e.idEstudiante=1;

----consulta auxiliar para ver estudiante y su carrera---
select e.primerNombre nombre, car.nombre carrera
from estudiante e
INNER JOIN contrato c
ON e.idEstudiante=c.idEstudiante
INNER JOIN carrera car
ON c.idCarrera=car.idCarrera;

---insertar ganancia y tipo de pago a la base de datos----
select e.primerNombre, sal.montoPago, sal.tipoPago
from saldoContrato sal INNER JOIN contrato con
ON sal.idContrato=con.idContrato
INNER JOIN estudiante e
ON con.idEstudiante=e.idEstudiante
AND e.idEstudiante=1;

INSERT INTO saldoContrato VALUES(null, 1, '2021-03-02', '4000', 'BecaConvenio');


----actualizar saldo-----
UPDATE saldoContrato SET saldo=45000 WHERE idContrato=1;