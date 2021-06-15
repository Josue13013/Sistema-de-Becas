<?php
require_once("../Modelo/BusquedaFinanciero.php");
class LNBusquedaFinanciero{
    private $objBusquedaFinanciero;
    
    function __construct()
    {
        $this->objBusquedaFinanciero =  new BusquedaFinanciero();
    }
    public function saldoEstudiante($id){
        return $this->objBusquedaFinanciero->saldoEstudiante($id);
    }
    public function detalleEstudiante2($id){
        return $this->objBusquedaFinanciero->detalleEstudiante2($id);
    }
    public function detalleEstudiante3($id){
        return $this->objBusquedaFinanciero->detalleEstudiante3($id);
    }
    public function actualizarSaldo($SaldoUpdate,$id){
        return $this->objBusquedaFinanciero->actualizarSaldo($SaldoUpdate,$id);
    }
}

?>