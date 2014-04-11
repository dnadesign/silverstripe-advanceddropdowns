# AdvancedDropdowns

## Introduction

DropdownField and GroupedDropdownField that allows the use of data-attributes on each option tag.
Very useful for third party dropdown styling such as (http://silviomoreto.github.io/bootstrap-select/) which rely on data-attributes on options.

Please note this module is a work in progress and has no tests.

## AdvandedDropdownField

Set up your AdvandedDropdownField's as follows:

```php
new AdvancedDropdownField('AdvancedDropdown', 'DropdownField with option attributes', array(
	'value1' => array(
		'Title' => 'Option 1',
		'Attributes' => array(
			'data-myattribute' => 'This is an attribute value'
		)
	),
	'value2' => array(
		'Title' => 'Option 2',
		'Attributes' => array(
			'data-myattribute' => 'This is an attribute value'
			'data-myattribute2' => 'This is a second attribute value'
		)
	)
));
```

## AdvandedGropuedDropdownField

Set up your AdvandedGroupedDropdownField's as follows:

```php
new AdvancedGroupedDropdownField('AdvancedGroupedDropdown', 'Advanced grouped dropdown', array(
	'value1' => array(
		'Title' => 'Ungrouped option',
		'Attributes' => array(
			'data-myattribute' => 'This is an attribute value'
		)
	),
	'Option group 1' => array(
		'value2' => array(
			'Title' => 'Option 2',
			'Attributes' => array(
				'data-myattribute' => 'This is an attribute value'
			)
		),
		'value3' => array(
			'Title' => 'Option 3',
			'Attributes' => array(
				'data-myattribute' => 'This is an attribute value'
			)
		)
	),
	'Option group 2' => array(
		'value4' => array(
			'Title' => 'Option 4',
			'Attributes' => array(
				'data-myattribute' => 'This is an attribute value'
			)
		),
		'value5' => array(
			'Title' => 'Option 5',
			'Attributes' => array(
				'data-myattribute' => 'This is an attribute value'
				'data-myattribute2' => 'This is a second attribute value'
			)
		)
	)
));
```

## Maintainer Contact

	* James ayers (james.ayers@dna.co.nz)

## Requirements

 * SilverStripe 3.x

## License

BSD-3-Clause. See LICENSE.