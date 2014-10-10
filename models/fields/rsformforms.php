<?php
include PLG_RDSTATION_BASE_DIR.'/lib/Com_rsformHelper.php';


/**
 * Description of rsFormForms
 *
 * @author Rodrigo emygdio da Silva Simas Pereira
 */

class JFormFieldRsFormForms extends JFormField {

    protected $type = "RsFormForms";
    
    public function __construct($form = null) {
        parent::__construct($form);
        
    }
    protected function getInput() {
        (string) $html = "";        
        (array) $fields = $this->getForms();
        (string) $titleFormsBox = JText::_($this->getAttribute('title_form_box'));

        while (!empty(current($fields))) {
            (int) $formId = (int) current($fields)["FormId"];
            (string) $legend = current($fields)["formName"];
            (string) $nameLeadTitle = JText::_('PLG_SYSTEM_RD_STATION_LEAD_RS_FORM_FORMS_NAME_LEAD');
            (string) $emailLeadTitle = JText::_('PLG_SYSTEM_RD_STATION_LEAD_RS_FORM_FORMS_EMAIL_LEAD');
            (string) $selectHtmlNameLead = "";
            (string) $selectHtmlEmailLead = "";

            $html .= "<fieldset>"
            ."  <legend>{$legend}:</legend>";
            $selectHtmlNameLead.="$nameLeadTitle: ";
            $selectHtmlEmailLead.="$emailLeadTitle: ";
            while (current($fields)["FormId"] == $formId) {
                (string) $value = current($fields)["name"];
                (string) $text = current($fields)["name"];
                $selectHtmlNameLead .="<input type=\"radio\"  value=\"$value\" name=\"jform[params][rsFormForms][{$formId}][nameLead]\" ".($this->isSelected($formId, "nameLead",$value)?'checked':'')." >  $text &nbsp;";
                $selectHtmlEmailLead .="<input type=\"radio\"  value=\"$value\" name=\"jform[params][rsFormForms][{$formId}][emailLead]\" ".($this->isSelected($formId, "emailLead",$value)?'checked':'').">  $text &nbsp;";
                next($fields);

            }
            $selectHtmlNameLead .= "  </select>";
            $selectHtmlEmailLead .= "  </select>";
            $html .= "$selectHtmlNameLead</br>$selectHtmlEmailLead</fieldset>";

            $formId = current($fields)["FormId"];
        }

        return $html;
    }

    protected static function getForms() {

        $dbo = JFactory::getDbo();
        $dbo->setQuery(
                "SELECT c.FormId, p.PropertyValue AS name, c.ComponentId, c.ComponentTypeId, "
                . "ct.ComponentTypeName, c.Order, forms.formName as formName "
                . "FROM #__rsform_properties p "
                . "  LEFT JOIN #__rsform_components c ON (c.ComponentId=p.ComponentId) "
                . "  LEFT JOIN #__rsform_component_types ct ON (ct.ComponentTypeId=c.ComponentTypeId) "
                . "  LEFT JOIN #__rsform_forms as forms On (forms.FormId = c.FormId)"
                . "WHERE  p.PropertyName='NAME' AND ct.ComponentTypeName = 'textBox' AND c.Published='1'"
                . " order by c.FormId"
        );

        return $dbo->loadAssocList();
    }
    protected function isSelected($formId, $nameField,$valueOfField){
       (array) $valueOfFieldFromParam =  Com_rsformHelper::getFormFromParam($formId);       
       
        if(!is_null($valueOfFieldFromParam) && $valueOfFieldFromParam[$nameField] == $valueOfField){
            return true;
        }
        return false;
    }
   

}
