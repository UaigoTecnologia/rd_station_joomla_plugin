<?php

include 'Com_rsformHelper.php';

/**
 * Description of com_rsform
 *
 * @author Rodrigo Emygdio 
 */
class Com_rsform {

    static $formId;
    static $form;

    public static function sendLeadForm($token, $lead_name) {
        static::$formId = !empty($_REQUEST['form']['formId']) ? (int) $_REQUEST['form']['formId'] : null;
        static::$form = Com_rsformHelper::getFormFromParam(static::$formId);
        (array) $formFromDb = Com_rsformHelper::getForm(static::$formId);
        
        if(empty($formFromDb)){
            return null;
        }
        
        (string) $lead_name = "form-".$formFromDb['FormName'];
        if (static::isRsForm()) {
            $data = array(
                'email' => $_REQUEST['form'][static::$form["emailLead"]],
                'nome' => $_REQUEST['form'][static::$form["nameLead"]],
            );
            addLeadConversionToRdstationCrm($token, $lead_name, $data);
        }
    }

    static function isRsForm() {
        return !empty(static::$form);
    }

}
