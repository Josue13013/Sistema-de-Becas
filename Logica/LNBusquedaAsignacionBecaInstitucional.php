<?php
require_once("../Modelo/BusquedaGestion.php");
class LNBusquedaAsignacionBecaInstitucional{
    private $objBusquedaGestion;
    
    function __construct()
    {
        $this->objBusquedaGestion =  new BusquedaGestion();
    }

    public function buscarEstudianteGestion($idGestion,$idEstudiante){
        return $this->objBusquedaGestion->verificarEstudianteGestion($idGestion,$idEstudiante);
    }
    public function listarEstudiantesBecados(){
        return $this->objBusquedaGestion->listarEstudiantesBecados();
    }
    public function detalleEstudiante($ci){
        return $this->objBusquedaGestion->detalleEstudiante($ci);
    }
    public function mes($fechaInicio,$fechaFin,$ci){
        return $this->objBusquedaGestion->mes($fechaInicio,$fechaFin,$ci);
    }
    public function dia($ci,$fecha){
        return $this->objBusquedaGestion->dia($ci,$fecha);
    }
    function fechaCastellano ($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
      $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        $fechita=$nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
        return $fechita;
        }
        public function totalTime($fechaInicio,$fechaFin,$ci){
            return $this->objBusquedaGestion->totalTime($fechaInicio,$fechaFin,$ci);
        }
}

?>