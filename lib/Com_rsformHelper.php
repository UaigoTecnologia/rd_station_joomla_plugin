<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Com_rsformHelper
 *
 * @author ubuntu
 */
class Com_rsformHelper {
    static protected $fields = array();

    static public function getFormFromParam($id){
        if(empty(static::$fields)){
            static::$fields = (array) json_decode(JPluginHelper::getPlugin('system','rdstation')->params)->rsFormForms;
        }
        
      foreach(static::$fields as $formId => $field){          
          if($formId == $id){
                return (array) $field;
          }  else {
              continue;
          }
      }
      
   }
   static public function getForm($id){ 
       $dbo = JFactory::getDbo();
       $query = $dbo->getQuery(true);
       $query->select("FormId,FormName")
               ->from("#__rsform_forms")
               ->where('Published=\'1\'')->where('FormId='.(int)$id);
       $dbo->setQuery($query);
       return $dbo->loadAssoc();
   }
}
