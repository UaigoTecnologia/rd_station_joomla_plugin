<?php

//include 'RDstationBase.php';
//ini_set('display_erros', true);
//error_reporting(E_ALL);
class Com_contact {
    public static function sendLeadForm($token,$lead_name){
        
        if(static::isContactJoomlaForm()){
//echo '<pre>';var_dump($_REQUEST);exit;
            $data = array(
                     'email'    =>   $_REQUEST['jform']['contact_email'],
                     'nome'     =>   $_REQUEST['jform']['contact_name'],
            );
            addLeadConversionToRdstationCrm($token,$lead_name, $data);
        }
    }
    static function  isContactJoomlaForm(){
        return (array_key_exists('jform', $_REQUEST) &&  $_REQUEST['option'] == 'com_contact');
    }
}
