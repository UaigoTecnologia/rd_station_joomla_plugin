<?php

defined('_JEXEC') or die('Restricted access');
JForm::addFieldPath(__DIR__ . '/models/fields');
define('PLG_RDSTATION_BASE_DIR',__DIR__);
/**
 * Description of classoverrider
 *
 * @author ubuntu
 */
class PlgSystemRdstation extends JPlugin {
    function onAfterRoute(){
        $app = JFactory::getApplication();         
        if($app->isSite()){
            
            if(!empty($_REQUEST) ){
                 include __DIR__.'/lib/rd_station_lib/rdstation-integracao.php';
                foreach($this->params->get('form') as $forms){
                    require __DIR__.'/lib/'.$forms.'.php';
//                    echo '<pre>';var_dump($_REQUEST);
                    $class = ucfirst($forms);
                    call_user_func(array($class,'sendLeadForm'),
                                    $this->params->get('token_rdsatation'),  $this->params->get('contact_form_lead_name')
                                   );
                    
                }
            }
        }
    }
}
