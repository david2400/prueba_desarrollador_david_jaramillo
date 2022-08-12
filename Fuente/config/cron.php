<?php
    
    $GLOBALS['app_code'] = "nt_devo_promodesc";
        

    $date=date('d-m-Y');
    $date_start = date ('d-m-Y', strtotime ('-1 month', strtotime($date)));
    $date_end=date ('d-m-Y', strtotime ('-1 day', strtotime($date)));

    

    class notas_contabilidad_promodesdsac_controller extends ControladorBase
{

    function hola(){
        return 'hola';
   }
}

$classb = new notas_contabilidad_promodesdsac_controller();

echo $classb->hola();
        

?>
