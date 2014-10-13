<?php
class Com_contact {
    public static function sendLeadForm($token,$lead_name){
        
        if(static::isContactJoomlaForm()){
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
