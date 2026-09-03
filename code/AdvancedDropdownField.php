<?php

namespace DNA\AdvancedDropdowns;

use SilverStripe\Model\ArrayData;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FormField;

class AdvancedDropdownField extends DropdownField
{
    protected $extraClasses = ['dropdown advanceddropdown'];

	public function Field($properties = [])
    {
		$source = $this->getSource();
		$options = [];

        if ($this->getHasEmptyDefault()) {
            $value = $this->getValue();
            $selected = $value === '' || $value === null;
			$disabled = $this->isDisabledValue('') ? 'disabled' : false;
			$empty = $this->getEmptyString();
			$options[] = new ArrayData([
				'Value' => '',
				'Title' => $empty,
				'Selected' => $selected,
				'Disabled' => $disabled,
				'Attributes' => $this->createOptionAttributes($empty)
			]);
		}

		if($source) {
			foreach($source as $value => $params) {

				$selected = false;
                $fieldValue = $this->getValue();
				if($value === '' && ($fieldValue === '' || $fieldValue === null)) {
					$selected = true;
				} else {
					// check against value, fallback to a type check comparison when !value
					if($value) {
                        $selected = ($value == $fieldValue);
					} else {
                        $selected = ($value === $fieldValue) || (((string) $value) === ((string) $fieldValue));
					}
				}

				$disabled = false;
				if($this->isDisabledValue($value) && $params['Title'] != $this->getEmptyString() ){
					$disabled = 'disabled';
				}

				$options[] = new ArrayData([
					'Title' => $params['Title'],
					'Value' => $value,
					'Selected' => $selected,
					'Disabled' => $disabled,
					'Attributes' => $this->createOptionAttributes($params)
				]);
			}
		}

		$properties = array_merge($properties, ['Options' => new ArrayList($options)]);

		return FormField::Field($properties);
	}

	public function createOptionAttributes($params)
    {
		$attributes = new ArrayList();
		if(isset($params['Attributes'])) {
			if($params['Attributes'] instanceOf ArrayList) {
				$attributes = $params['Attributes'];
			} else {
				foreach($params['Attributes'] as $k => $v) {
					$attributes->push(new ArrayData([
						'Name' => $k,
						'Value' => $v
					]));
				}
			}
		}
		return $attributes;
	}
}





