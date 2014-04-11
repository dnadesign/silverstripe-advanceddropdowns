<?php

class AdvancedDropdownField extends DropDownField {

	protected $extraClasses = array('dropdown advanceddropdown');


	public function Field($properties = array()) {
		$source = $this->getSource();
		$options = array();
		if($source) {
			// SQLMap needs this to add an empty value to the options
			if(is_object($source) && $this->emptyString) {
				$options[] = new ArrayData(array(
					'Value' => '',
					'Title' => $this->emptyString,
				));
			}

			foreach($source as $value => $params) {


				$selected = false;
				if($value === '' && ($this->value === '' || $this->value === null)) {
					$selected = true;
				} else {
					// check against value, fallback to a type check comparison when !value
					if($value) {
						$selected = ($value == $this->value);
					} else {
						$selected = ($value === $this->value) || (((string) $value) === ((string) $this->value));
					}

					$this->isSelected = $selected;
				}
				
				$disabled = false;
				if(in_array($value, $this->disabledItems) && $params['Title'] != $this->emptyString ){
					$disabled = 'disabled';
				}
				
				$options[] = new ArrayData(array(
					'Title' => $params['Title'],
					'Value' => $value,
					'Selected' => $selected,
					'Disabled' => $disabled,
					'Attributes' => $this->createOptionAttributes($params)
				));
			}
		}

		$properties = array_merge($properties, array('Options' => new ArrayList($options)));

		return FormField::Field($properties);
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





