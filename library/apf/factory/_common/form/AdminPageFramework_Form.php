<?php 
/**
	Admin Page Framework v3.8.15 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/admin-page-framework>
	Copyright (c) 2013-2017, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
abstract class AdminPageFramework_Form_Utility extends AdminPageFramework_FrameworkUtility {
    static public function getElementPathAsArray($asPath) {
        if (is_array($asPath)) {
            return;
        }
        return explode('|', $asPath);
    }
    static public function getFormElementPath($asID) {
        return implode('|', self::getAsArray($asID));
    }
    static public function getIDSanitized($asID) {
        return is_scalar($asID) ? self::sanitizeSlug($asID) : self::getAsArray($asID);
    }
    static public function hasNestedFields($aFieldset) {
        if (!self::hasFieldDefinitionsInContent($aFieldset)) {
            return false;
        }
        if ('inline_mixed' === self::getElement($aFieldset, 'type')) {
            return false;
        }
        return is_array(self::getElement($aFieldset['content'], 0));
    }
    static public function hasFieldDefinitionsInContent($aFieldset) {
        if (!isset($aFieldset['content'])) {
            return false;
        }
        if (empty($aFieldset['content'])) {
            return false;
        }
        return is_array($aFieldset['content']);
    }
    static public function hasSubFields(array $aFields, $aField) {
        if (count($aFields) > 1) {
            return true;
        }
        if (self::isDynamicField($aField)) {
            return true;
        }
        return false;
    }
    static public function isDynamicField($aField) {
        if (!empty($aField['repeatable'])) {
            return true;
        }
        if (!empty($aField['sortable'])) {
            return true;
        }
        return false;
    }
    static public function getTrailingPipeCharacterAppended($sString) {
        if (empty($sString)) {
            return $sString;
        }
        return $sString . '|';
    }
    static public function getFieldsetReformattedBySubFieldIndex($aFieldset, $iSubFieldIndex, $bHasSubFields, $aParentFieldset) {
        $_oCallerForm = $aFieldset['_caller_object'];
        $aFieldset['_parent_field_path'] = self::getAOrB($bHasSubFields, $aFieldset['_parent_field_path'] . '|' . $iSubFieldIndex, $aFieldset['_parent_field_path']);
        $aFieldset['_parent_tag_id'] = self::getAOrB($bHasSubFields, $aParentFieldset['tag_id'] . '__' . $iSubFieldIndex, $aParentFieldset['tag_id']);
        $_oFieldsetFormatter = new AdminPageFramework_Form_Model___Format_Fieldset($aFieldset, $aFieldset['_structure_type'], $aFieldset['capability'], ( integer )$iSubFieldIndex + 1, $aFieldset['_subsection_index'], $aFieldset['_is_section_repeatable'], $aFieldset['_caller_object']);
        $aFieldset = $_oFieldsetFormatter->get();
        $_oFieldsetOutputFormatter = new AdminPageFramework_Form_Model___Format_FieldsetOutput($aFieldset, $aFieldset['_section_index'], $_oCallerForm->aFieldTypeDefinitions);
        return $_oFieldsetOutputFormatter->get();
    }
    static public function isNormalPlacement(array $aFieldset) {
        if ('section_title' === $aFieldset['type']) {
            return false;
        }
        return 'normal' === $aFieldset['placement'];
    }
    static public function getModalForDisabledRepeatableElement($sBoxElementID, $aArguments) {
        if (empty($aArguments)) {
            return '';
        }
        if (self::hasBeenCalled('disabled_repeatable_elements_modal_' . $sBoxElementID)) {
            return '';
        }
        add_thickbox();
        return "<div id='{$sBoxElementID}' style='display:none'>" . "<p>" . $aArguments['message'] . "</p>" . "</div>";
    }
}
abstract class AdminPageFramework_Form_Base extends AdminPageFramework_Form_Utility {
    static public $_aResources = array('internal_styles' => array(), 'internal_styles_ie' => array(), 'internal_scripts' => array(), 'src_styles' => array(), 'src_scripts' => array(),);
    public function isSection($sID) {
        if ($this->isNumericInteger($sID)) {
            return false;
        }
        if (!array_key_exists($sID, $this->aSectionsets)) {
            return false;
        }
        if (!array_key_exists($sID, $this->aFieldsets)) {
            return false;
        }
        $_bIsSeciton = false;
        foreach ($this->aFieldsets as $_sSectionID => $_aFields) {
            if ($_sSectionID == $sID) {
                $_bIsSeciton = true;
            }
            if (array_key_exists($sID, $_aFields)) {
                return false;
            }
        }
        return $_bIsSeciton;
    }
    public function canUserView($sCapability) {
        if (!$sCapability) {
            return true;
        }
        return ( boolean )current_user_can($sCapability);
    }
    public function isInThePage() {
        return $this->callBack($this->aCallbacks['is_in_the_page'], true);
    }
    public function __toString() {
        return $this->getObjectInfo($this);
    }
}
class AdminPageFramework_Form_Model extends AdminPageFramework_Form_Base {
    public function __construct() {
        if ($this->aArguments['register_if_action_already_done']) {
            $this->registerAction($this->aArguments['action_hook_form_registration'], array($this, '_replyToRegisterFormItems'), 100);
        } else {
            add_action($this->aArguments['action_hook_form_registration'], array($this, '_replyToRegisterFormItems'));
        }
    }
    public function getSubmittedData(array $aDataToParse, $bExtractFromFieldStructure = true, $bStripSlashes = true) {
        $_aSubmittedFormData = $bExtractFromFieldStructure ? $this->castArrayContents($this->getDataStructureFromAddedFieldsets(), $aDataToParse) : $aDataToParse;
        $_aSubmittedFormData = $this->getSortedInputs($_aSubmittedFormData);
        return $bStripSlashes ? stripslashes_deep($_aSubmittedFormData) : $_aSubmittedFormData;
    }
    public function getSortedInputs(array $aFormInputs) {
        $_aDynamicFieldAddressKeys = array_unique(array_merge($this->getElementAsArray($_POST, '__repeatable_elements_' . $this->aArguments['structure_type'], array()), $this->getElementAsArray($_POST, '__sortable_elements_' . $this->aArguments['structure_type'], array())));
        if (empty($_aDynamicFieldAddressKeys)) {
            return $aFormInputs;
        }
        $_oInputSorter = new AdminPageFramework_Form_Model___Modifier_SortInput($aFormInputs, $_aDynamicFieldAddressKeys);
        return $_oInputSorter->get();
    }
    public function getDataStructureFromAddedFieldsets() {
        $_aFormDataStructure = array();
        foreach ($this->getAsArray($this->aFieldsets) as $_sSectionID => $_aFieldsets) {
            if ($_sSectionID != '_default') {
                $_aFormDataStructure[$_sSectionID] = $_aFieldsets;
                continue;
            }
            foreach ($_aFieldsets as $_sFieldID => $_aFieldset) {
                $_aFormDataStructure[$_aFieldset['field_id']] = $_aFieldset;
            }
        }
        return $_aFormDataStructure;
    }
    public function dropRepeatableElements(array $aSubject) {
        $_oFilterRepeatableElements = new AdminPageFramework_Form_Model___Modifier_FilterRepeatableElements($aSubject, $this->getElementAsArray($_POST, '__repeatable_elements_' . $this->aArguments['structure_type']));
        return $_oFilterRepeatableElements->get();
    }
    public function _replyToRegisterFormItems() {
        if (!$this->isInThePage()) {
            return;
        }
        $this->_setFieldTypeDefinitions('admin_page_framework');
        $this->_setFieldTypeDefinitions($this->aArguments['caller_id']);
        $this->aSavedData = $this->_getSavedData($this->aSavedData + $this->getDefaultFormValues());
        $this->_handleCallbacks();
        $_oFieldResources = new AdminPageFramework_Form_Model___SetFieldResources($this->aArguments, $this->aFieldsets, self::$_aResources, $this->aFieldTypeDefinitions, $this->aCallbacks);
        self::$_aResources = $_oFieldResources->get();
        $this->callBack($this->aCallbacks['handle_form_data'], array($this->aSavedData, $this->aArguments, $this->aSectionsets, $this->aFieldsets,));
    }
    private function _handleCallbacks() {
        $this->aSectionsets = $this->callBack($this->aCallbacks['secitonsets_before_registration'], array($this->aSectionsets,));
        $this->aFieldsets = $this->callBack($this->aCallbacks['fieldsets_before_registration'], array($this->aFieldsets, $this->aSectionsets,));
    }
    static private $_aFieldTypeDefinitions = array('admin_page_framework' => array(),);
    private function _setFieldTypeDefinitions($_sCallerID) {
        if ('admin_page_framework' === $_sCallerID) {
            $this->_setSiteWideFieldTypeDefinitions();
        }
        $this->aFieldTypeDefinitions = apply_filters("field_types_{$_sCallerID}", self::$_aFieldTypeDefinitions['admin_page_framework']);
    }
    private function _setSiteWideFieldTypeDefinitions() {
        if ($this->hasBeenCalled('__filed_types_admin_page_framework')) {
            return;
        }
        $_oBuiltInFieldTypeDefinitions = new AdminPageFramework_Form_Model___BuiltInFieldTypeDefinitions('admin_page_framework', $this->oMsg);
        self::$_aFieldTypeDefinitions['admin_page_framework'] = apply_filters('field_types_admin_page_framework', $_oBuiltInFieldTypeDefinitions->get());
    }
    private function _getSavedData($aDefaultValues) {
        $_aSavedData = $this->getAsArray($this->callBack($this->aCallbacks['saved_data'], array($aDefaultValues,))) + $aDefaultValues;
        $_aLastInputs = $this->getElement($_GET, 'field_errors') || isset($_GET['confirmation']) ? $this->oLastInputs->get() : array();
        return $_aLastInputs + $_aSavedData;
    }
    public function getDefaultFormValues() {
        $_oDefaultValues = new AdminPageFramework_Form_Model___DefaultValues($this->aFieldsets);
        return $_oDefaultValues->get();
    }
    protected function _formatElementDefinitions(array $aSavedData) {
        $_oSectionsetsFormatter = new AdminPageFramework_Form_Model___FormatSectionsets($this->aSectionsets, $this->aArguments['structure_type'], $this->sCapability, $this->aCallbacks, $this);
        $this->aSectionsets = $_oSectionsetsFormatter->get();
        $_oFieldsetsFormatter = new AdminPageFramework_Form_Model___FormatFieldsets($this->aFieldsets, $this->aSectionsets, $this->aArguments['structure_type'], $this->aSavedData, $this->sCapability, $this->aCallbacks, $this);
        $this->aFieldsets = $_oFieldsetsFormatter->get();
    }
    public function getFieldErrors() {
        $_aErrors = $this->oFieldError->get();
        $this->oFieldError->delete();
        return $_aErrors;
    }
    public function setLastInputs(array $aLastInputs) {
        $this->oLastInputs->set($aLastInputs);
    }
}
class AdminPageFramework_Form_View extends AdminPageFramework_Form_Model {
    public function __construct() {
        parent::__construct();
        new AdminPageFramework_Form_View__Resource($this);
    }
    public function get() {
        $this->sCapability = $this->callBack($this->aCallbacks['capability'], '');
        if (!$this->canUserView($this->sCapability)) {
            return '';
        }
        $this->_formatElementDefinitions($this->aSavedData);
        new AdminPageFramework_Form_View___Script_Form;
        $_oFormTables = new AdminPageFramework_Form_View___Sectionsets(array('capability' => $this->sCapability,) + $this->aArguments, array('field_type_definitions' => $this->aFieldTypeDefinitions, 'sectionsets' => $this->aSectionsets, 'fieldsets' => $this->aFieldsets,), $this->aSavedData, $this->callBack($this->aCallbacks['field_errors'], array($this->getFieldErrors())), $this->aCallbacks, $this->oMsg);
        return $this->_getNoScriptMessage() . $_oFormTables->get();
    }
    private function _getNoScriptMessage() {
        if ($this->hasBeenCalled(__METHOD__)) {
            return;
        }
        return "<noscript>" . "<div class='error'>" . "<p class='admin-page-framework-form-warning'>" . $this->oMsg->get('please_enable_javascript') . "</p>" . "</div>" . "</noscript>";
    }
    public function printSubmitNotices() {
        $this->oSubmitNotice->render();
    }
}
class AdminPageFramework_Form_Controller extends AdminPageFramework_Form_View {
    public function setFieldErrors($aErrors) {
        $this->oFieldError->set($aErrors);
    }
    public function hasFieldError() {
        return $this->oFieldError->hasError();
    }
    public function hasSubmitNotice($sType = '') {
        return $this->oSubmitNotice->hasNotice($sType);
    }
    public function setSubmitNotice($sMessage, $sType = 'error', $asAttributes = array(), $bOverride = true) {
        $this->oSubmitNotice->set($sMessage, $sType, $asAttributes, $bOverride);
    }
    public function addSection(array $aSectionset) {
        $aSectionset = $aSectionset + array('section_id' => null,);
        $aSectionset['section_id'] = $this->sanitizeSlug($aSectionset['section_id']);
        $this->aSectionsets[$aSectionset['section_id']] = $aSectionset;
        $this->aFieldsets[$aSectionset['section_id']] = $this->getElement($this->aFieldsets, $aSectionset['section_id'], array());
    }
    public function removeSection($sSectionID) {
        if ('_default' === $sSectionID) {
            return;
        }
        unset($this->aSectionsets[$sSectionID], $this->aFieldsets[$sSectionID]);
    }
    public function getResources($sKey) {
        return $this->getElement(self::$_aResources, $sKey);
    }
    public function unsetResources($aKeys) {
        $this->unsetDimensionalArrayElement(self::$_aResources, $aKeys);
    }
    public function setResources($sKey, $mValue) {
        return self::$_aResources[$sKey] = $mValue;
    }
    public function addResource($sKey, $sValue) {
        self::$_aResources[$sKey][] = $sValue;
    }
    protected $_asTargetSectionID = '_default';
    public function addField($asFieldset) {
        if (!$this->_isFieldsetDefinition($asFieldset)) {
            $this->_asTargetSectionID = $this->_getTargetSectionID($asFieldset);
            return $this->_asTargetSectionID;
        }
        $_aFieldset = $asFieldset;
        $this->_asTargetSectionID = $this->getElement($_aFieldset, 'section_id', $this->_asTargetSectionID);
        if (!isset($_aFieldset['field_id'])) {
            return null;
        }
        $this->_setFieldset($_aFieldset);
        return $_aFieldset;
    }
    private function _setFieldset(array $aFieldset) {
        $aFieldset = array('_fields_type' => $this->aArguments['structure_type'], '_structure_type' => $this->aArguments['structure_type'],) + $aFieldset + array('section_id' => $this->_asTargetSectionID, 'class_name' => $this->aArguments['caller_id'],);
        $aFieldset['field_id'] = $this->getIDSanitized($aFieldset['field_id']);
        $aFieldset['section_id'] = $this->getIDSanitized($aFieldset['section_id']);
        $_aSectionPath = $this->getAsArray($aFieldset['section_id']);
        $_sSectionPath = implode('|', $_aSectionPath);
        $_aFieldPath = $this->getAsArray($aFieldset['field_id']);
        $_sFieldPath = implode('|', $_aFieldPath);
        $this->aFieldsets[$_sSectionPath][$_sFieldPath] = $aFieldset;
    }
    private function _isFieldsetDefinition($asFieldset) {
        if (is_scalar($asFieldset)) {
            return false;
        }
        return $this->isAssociative($asFieldset);
    }
    private function _getTargetSectionID($asTargetSectionID) {
        if (is_scalar($asTargetSectionID)) {
            return $asTargetSectionID;
        }
        return $asTargetSectionID;
    }
    public function removeField($sFieldID) {
        foreach ($this->aFieldsets as $_sSectionID => $_aSubSectionsOrFields) {
            if (array_key_exists($sFieldID, $_aSubSectionsOrFields)) {
                unset($this->aFieldsets[$_sSectionID][$sFieldID]);
            }
            foreach ($_aSubSectionsOrFields as $_sIndexOrFieldID => $_aSubSectionOrFields) {
                if ($this->isNumericInteger($_sIndexOrFieldID)) {
                    if (array_key_exists($sFieldID, $_aSubSectionOrFields)) {
                        unset($this->aFieldsets[$_sSectionID][$_sIndexOrFieldID]);
                    }
                    continue;
                }
            }
        }
    }
}
class AdminPageFramework_Form extends AdminPageFramework_Form_Controller {
    public $sStructureType = '';
    public $aFieldTypeDefinitions = array();
    public $aSectionsets = array('_default' => array('section_id' => '_default',),);
    public $aFieldsets = array();
    public $aSavedData = array();
    public $sCapability = '';
    public $aCallbacks = array('capability' => null, 'is_in_the_page' => null, 'is_fieldset_registration_allowed' => null, 'load_fieldset_resource' => null, 'saved_data' => null, 'fieldset_output' => null, 'section_head_output' => null, 'sectionset_before_output' => null, 'fieldset_before_output' => null, 'is_sectionset_visible' => null, 'is_fieldset_visible' => null, 'secitonsets_before_registration' => null, 'fieldsets_before_registration' => null, 'fieldset_after_formatting' => null, 'fieldsets_before_formatting' => null, 'handle_form_data' => null, 'show_debug_info' => null, 'field_errors' => null, 'hfID' => null, 'hfTagID' => null, 'hfName' => null, 'hfNameFlat' => null, 'hfInputName' => null, 'hfInputNameFlat' => null, 'hfClass' => null, 'hfSectionName' => null,);
    public $oMsg;
    public $aArguments = array('caller_id' => '', 'structure_type' => 'admin_page', 'action_hook_form_registration' => 'current_screen', 'register_if_action_already_done' => true,);
    public $oSubmitNotice;
    public $oFieldError;
    public $oLastInputs;
    public $aSubClasses = array('submit_notice' => 'AdminPageFramework_Form___SubmitNotice', 'field_error' => 'AdminPageFramework_Form___FieldError', 'last_input' => 'AdminPageFramework_Form_Model___LastInput', 'message' => 'AdminPageFramework_Message',);
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aArguments, $this->aCallbacks, $this->oMsg,);
        $this->aArguments = $this->___getArgumentsFormatted($_aParameters[0]);
        $this->aCallbacks = $this->getAsArray($_aParameters[1]) + $this->aCallbacks;
        $this->oMsg = $_aParameters[2] ? $_aParameters[2] : new $this->aSubClasses['message'];
        $this->___setSubClassObjects();
        parent::__construct();
        $this->construct();
    }
    private function ___getArgumentsFormatted($aArguments) {
        $aArguments = $this->getAsArray($aArguments) + $this->aArguments;
        $aArguments['caller_id'] = $aArguments['caller_id'] ? $aArguments['caller_id'] : get_class($this);
        if ($this->sStructureType) {
            $aArguments['structure_type'] = $this->sStructureType;
        }
        return $aArguments;
    }
    private function ___setSubClassObjects() {
        if (class_exists($this->aSubClasses['submit_notice'])) {
            $this->oSubmitNotice = new $this->aSubClasses['submit_notice'];
        }
        if (class_exists($this->aSubClasses['field_error'])) {
            $this->oFieldError = new $this->aSubClasses['field_error']($this->aArguments['caller_id']);
        }
        if (class_exists($this->aSubClasses['last_input'])) {
            $this->oLastInputs = new $this->aSubClasses['last_input']($this->aArguments['caller_id']);
        }
    }
    public function construct() {
    }
}
