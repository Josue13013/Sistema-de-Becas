<?php
require_once("../Modelo/DescargaDatosFinanciero.php");

class LNDescargaFinanciero{
    private $objDescargaFinanciero;
    
    function __construct()
    {
        $this->objDescargaFinanciero =  new DescargaDatosFinanciero();
    }
    public function Descargar($id,$fechaActual,$Ganancia){
        return $this->objDescargaFinanciero->Descargo($id,$fechaActual,$Ganancia);
    }
}

?>