<?php

defined('_JEXEC') or die('Restricted access');
/**
 * Description of classoverrider
 *
 * @author ubuntu
 */
class PlgSystemRdstation extends JPlugin {
    function onAfterRoute(){
        $app = JFactory::getApplication();         
        if($app->isSite()){
//             echo '<pre>';var_dump($this->params->get('form'));exit;
            if(!empty($_REQUEST) ){
                foreach($this->params->get('form') as $forms){
                    require __DIR__.'/lib/'.$forms.'.php';
                    $class = ucfirst($forms);
                    call_user_func(array($class,'sendLeadForm'),
                                    $this->params->get('token_rdsatation'),  $this->params->get('contact_form_lead_name')
                                   );
                    
                }
            }
        }
    }
}
