<?php

class AdvancedGroupedDropdownField extends GroupedDropDownField {

	public function Field($properties = array()) {
		$options = '';
		foreach($this->getSource() as $value => $params) {
			if(is_array($params) && !array_key_exists('Title', $params)) {
				$options .= "<optgroup label=\"$value\">";
				foreach($params as $value2 => $params2) {
					
					$disabled = '';
					if( array_key_exists($value, $this->disabledItems)
							&& is_array($this->disabledItems[$value]) 
							&& in_array($value2, $this->disabledItems[$value]) ){
						$disabled = 'disabled="disabled"';
					}
					$selected = $value2 == $this->value ? " selected=\"selected\"" : "";
					$optionTitle = $params2['Title'];
					$attributes = $this->createOptionAttributes($params2);
					$optionAttributes = '';
					foreach($attributes as $attribute) {
						$optionAttributes .= " $attribute->Name=\"$attribute->Value\"";
					}
					$options .= "<option$selected value=\"$value2\" $disabled $optionAttributes>$optionTitle</option>";
				}
				$options .= "</optgroup>";
			} else { // Fall back to the standard dropdown field
				$disabled = '';
				if( in_array($value, $this->disabledItems) ){
					$disabled = 'disabled="disabled"';
				}
				$selected = $value == $this->value ? " selected=\"selected\"" : "";
				$optionTitle = $params['Title'];
				$attributes = $this->createOptionAttributes($params);
				$optionAttributes = '';
				foreach($attributes as $attribute) {
					$optionAttributes .= " $attribute->Name=\"$attribute->Value\"";
				}

				$options .= "<option$selected value=\"$value\" $disabled $optionAttributes>$optionTitle</option>";
			}
		}

		return FormField::create_tag('select', $this->getAttributes(), $options);
	}

	public function Type() {
		return 'groupeddropdown dropdown';
	}

	public function createOptionAttributes($params) {
		$attributes = new ArrayList();
		if(isset($params['Attributes'])) {
			if($params['Attributes'] instanceOf ArrayList) {
				$attributes = $params['Attributes'];
			} else {
				foreach($params['Attributes'] as $k => $v) {
					$attributes->push(new ArrayData(array(
						'Name' => $k,
						'Value' => $v
					)));
				}
			}
		}
		return $attributes;
	}
	

}