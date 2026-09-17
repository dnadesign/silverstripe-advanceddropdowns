<?php

declare(strict_types=1);

namespace DNA\AdvancedDropdowns\Tests;

use DNA\AdvancedDropdowns\AdvancedGroupedDropdownField;
use SilverStripe\Dev\SapphireTest;

require_once dirname(__DIR__) . '/code/AdvancedGroupedDropdownField.php';

final class AdvancedGroupedDropdownFieldTest extends SapphireTest
{
    protected $usesDatabase = false;

    public function testGroupedDisabledItems(): void
    {
        $field = new TestableAdvancedGroupedDropdownField(
            'Country',
            'Country',
            [
                'Countries' => [
                    'NZ' => ['Title' => 'New Zealand'],
                    'AU' => ['Title' => 'Australia'],
                ],
                'Other' => [
                    'XX' => ['Title' => 'Other'],
                ],
            ]
        );

        $field->setGroupedDisabledItems([
            'Countries' => ['NZ'],
            'Other' => ['XX'],
        ]);

        $html = (string) $field->Field();

        $this->assertStringContainsString(
            'value="NZ" disabled="disabled"',
            $html
        );

        $this->assertStringContainsString(
            'value="XX" disabled="disabled"',
            $html
        );

        $this->assertStringNotContainsString(
            'value="AU" disabled="disabled"',
            $html
        );
    }
}

class TestableAdvancedGroupedDropdownField extends AdvancedGroupedDropdownField
{
    public function setGroupedDisabledItems(array $items): static
    {
        $this->disabledItems = $items;
        return $this;
    }
}
