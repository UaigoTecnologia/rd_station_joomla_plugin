<?php
include __DIR__.'/rd_station_lib/rdstation-integracao.php';
//include 'RDstationBase.php';
//ini_set('display_erros', true);
//error_reporting(E_ALL);
class Com_contact {
    public static function sendLeadForm($token,$lead_name){
//        echo '<pre>';var_dump(array_key_exists('jform', $_REQUEST));exit;
        if(array_key_exists('jform', $_REQUEST)){
//            echo '<pre>';var_dump($lead_name);exit;
            $data = array(
                     'email'    =>   $_REQUEST['jform']['contact_email'],
                     'nome'     =>   $_REQUEST['jform']['contact_name'],
            );
            addLeadConversionToRdstationCrm($token,$lead_name, $data);
        }
    }
}
