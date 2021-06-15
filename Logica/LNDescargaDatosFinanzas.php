<?php
require_once("../Modelo/DescargaDatosFinanciero.php");

class LNDescargaFinanciero{
    private $objDescargaFinanciero;
    
    function __construct()
    {
        $this->objDescargaFinanciero =  new DescargaDatosFinanciero();
    }
    public function Descargar($id,$Ganancia,$fechaActual){
        return $this->objDescargaFinanciero->Descargo($id,$Ganancia,$fechaActual);
    }
}

?>