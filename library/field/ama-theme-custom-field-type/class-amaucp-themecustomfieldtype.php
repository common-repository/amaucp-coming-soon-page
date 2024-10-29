<?php 
/**
based on Admin Page Framework v3.8.15 by Michael Uno 
*/
if ( !class_exists( 'AMAUCP_ThemeCustomFieldType' ) ) :

	class AMAUCP_ThemeCustomFieldType extends AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('ama-theme');
    protected $aDefaultKeys = array('label' => array(), 'attributes' => array(),);
    protected function getStyles() {
        return ".admin-page-framework-field input[type='radio'] {margin-right: 0.5em;} .admin-page-framework-field-radio .admin-page-framework-input-label-container {padding-right: 1em;} .admin-page-framework-field-radio .admin-page-framework-input-container {display: inline;} .admin-page-framework-field-radio .admin-page-framework-input-label-string{display: inline; } .ama-theme-screenshot{ width:160px;height:90px;} .ama-theme-screenshot img{max-width:100%;max-height:100%;} .ama-disable{background-color:#888888;}";
    }
    protected function getScripts() {
        return '';
    }
    protected function getField($aField) {
        $_aOutput = array();
        foreach ($this->getAsArray($aField['label']) as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getEachRadioButtonOutput($aField, $_sKey, $_sLabel['theme']);
        }
        $_aOutput[] = $this->_getUpdateCheckedScript($aField['input_id']);
        return implode(PHP_EOL, $_aOutput);
    }
    private function _getEachRadioButtonOutput(array $aField, $sKey, $sLabel) {
		$amaClass = ' ama-enable';
		if ($aField['label'][$sKey]['enable']==0) {
			$amaClass = ' ama-disable';
		}
        $_aAttributes = $aField['attributes'] + $this->getElementAsArray($aField, array('attributes', $sKey));
        $_oRadio = new AdminPageFramework_Input_radio($_aAttributes);
        $_oRadio->setAttributesByKey($sKey);
		$ama_image = '<div class="ama-theme-screenshot"><img src="'. $aField['label'][$sKey]['screenshot'] . '" /></div>';
		$ama_preview = '<div class="ama-theme-screenshot"><a target="_blank" href="'. $aField['label'][$sKey]['preview'] .'" title="">Preview</a></div>';
		$ama_enable = 
        $_oRadio->setAttribute('data-default', $aField['default']);
        return $this->getElementByLabel($aField['before_label'], $sKey, $aField['label']) . "<div " . $this->getLabelContainerAttributes($aField, 'admin-page-framework-input-label-container admin-page-framework-radio-label' . $amaClass) . ">" .  "<label " . $this->getAttributes(array('for' => $_oRadio->getAttribute('id'), 'class' => $_oRadio->getAttribute('disabled') ? 'disabled' : null,)) . ">" . $ama_image . $this->getElementByLabel($aField['before_input'], $sKey, $aField['label']) . $_oRadio->get($sLabel) . $this->getElementByLabel($aField['after_input'], $sKey, $aField['label']) . $ama_preview . "</label>" . "</div>" . $this->getElementByLabel($aField['after_label'], $sKey, $aField['label']);
    }
    private function _getUpdateCheckedScript($sInputID) {
        $_sScript = <<<JAVASCRIPTS
	jQuery( document ).ready( function(){
	jQuery('.ama-disable input[type=radio]').on('click', function() {
		alert('Only availabe in Add Ons Plugins');
		return false;
	});
    jQuery( 'input[type=radio][data-id=\"{$sInputID}\"]' ).change( function() {
        // Uncheck the other radio buttons
        jQuery( this ).closest( '.admin-page-framework-field' ).find( 'input[type=radio][data-id=\"{$sInputID}\"]' ).attr( 'checked', false );

        // Make sure the clicked item is checked
        jQuery( this ).attr( 'checked', 'checked' );
    });
});                 
JAVASCRIPTS;
        return "<script type='text/javascript' class='radio-button-checked-attribute-updater'>" . '/* <![CDATA[ */' . $_sScript . '/* ]]> */' . "</script>";
    }
}

endif;