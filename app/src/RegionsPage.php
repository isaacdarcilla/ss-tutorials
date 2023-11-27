<?php

namespace SilverStripe\Lessons;

use Page;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * @method Regions()
 */
class RegionsPage extends Page
{
    private static array $has_many = [
        'Regions' => Region::class
    ];

    private static array $owns = [
        'Regions'
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Regions', GridField::create(
            'Regions',
            'Regions on this page',
            $this->Regions(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}