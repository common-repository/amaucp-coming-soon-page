<?php 
/**
	Admin Page Framework v3.8.15 by Michael Uno 
*/
if ( !class_exists( 'AMAUCP_CustomFieldType' ) ) :

class AMAUCP_CustomFieldType extends AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('ama-datetime');
    protected $aDefaultKeys = array('attributes'    =>  array(
            'class'        => 'ama-datepicker'
        ));
    protected function setUp() {
		 wp_enqueue_script( 'jquery' );
		 wp_enqueue_script( 'jquery-ui-datepicker' );
		 // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
		wp_register_style( 'jquery-ui', AMAUCP_PLUGIN_URL . 'public/css/jquery-ui.css' );
		wp_enqueue_style( 'jquery-ui' ); 
    }
	protected function getEnqueuingScripts() {
		return array(
            array( 'src'    => AMAUCP_PLUGIN_URL . 'public/js/ace.js', 'dependencies'    => array( 'jquery' ) ),
        );
	}
	
    protected function getScripts() {
             return "jQuery( document ).ready( function(){
				 jQuery('.ama-datepicker').datepicker({ dateFormat: 'm/d/yy' });
			 });";
    }
	
    protected function getStyles() {
        return "";
    }
	 protected function getField($aField) {
        $_aOutput = array();
        foreach (( array )$aField['label'] as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getFieldOutputByLabel($_sKey, $_sLabel, $aField);
        }
        $_aOutput[] = "<div class='repeatable-field-buttons'></div>";
        return implode('', $_aOutput);
    }
    private function _getFieldOutputByLabel($sKey, $sLabel, $aField) {
        $_bIsArray = is_array($aField['label']);
        $_sClassSelector = $_bIsArray ? 'admin-page-framework-field-text-multiple-labels' : '';
        $_sLabel = $this->getElementByLabel($aField['label'], $sKey, $aField['label']);
        $aField['value'] = $this->getElementByLabel($aField['value'], $sKey, $aField['label']);
        $_aInputAttributes = $_bIsArray ? array('name' => $aField['attributes']['name'] . "[{$sKey}]", 'id' => $aField['attributes']['id'] . "_{$sKey}", 'value' => $aField['value'],) + $this->getAsArray($this->getElementByLabel($aField['attributes'], $sKey, $aField['label'])) + $aField['attributes'] : $aField['attributes'];
        $_aOutput = array($this->getElementByLabel($aField['before_label'], $sKey, $aField['label']), "<div class='admin-page-framework-input-label-container {$_sClassSelector}'>", "<label for='" . $_aInputAttributes['id'] . "'>", $this->getElementByLabel($aField['before_input'], $sKey, $aField['label']), $_sLabel ? "<span " . $this->getLabelContainerAttributes($aField, 'admin-page-framework-input-label-string') . ">" . $_sLabel . "</span>" : '', "<input " . str_replace("type='ama-datetime'",'type="text"',$this->getAttributes($_aInputAttributes)) . " />", $this->getElementByLabel($aField['after_input'] , $sKey, $aField['label']), "</label>", "</div>", $this->getElementByLabel($aField['after_label'], $sKey, $aField['label']),);
        return implode('', $_aOutput);
    }
}

endif;