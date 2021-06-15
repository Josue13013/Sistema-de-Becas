<?php
require_once("../Modelo/RegistroEntradaSalidaPersistencia.php");
class LNRegistroEntradaSalidaPersistencia{
    private $objRegistroEntradaSalidaPersistencia;
    function __construct()
    {
        $this->objRegistroEntradaSalidaPersistencia =  new RegistroEntradaSalidaPersistencia();
    }
    public function registroEntrada($idAsignacionBecaInstitucional,$fecha,$horaInicio) {
        return $this->objRegistroEntradaSalidaPersistencia->registroEntrada($idAsignacionBecaInstitucional,$fecha,$horaInicio);
    }

    public function registroSalida($idRegistroEntradaSalida,$horaFin){
        return $this->objRegistroEntradaSalidaPersistencia->registroSalida($idRegistroEntradaSalida,$horaFin);
    }
    public function actualizarTotalHoras($idRegistroEntradaSalida,$hora){
        return $this->objRegistroEntradaSalidaPersistencia->actualizarTotalHoras($idRegistroEntradaSalida,$hora);
    }
}//end class
?>