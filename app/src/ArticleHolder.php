<?php

namespace SilverStripe\Lessons;

use Page;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * @method Categories()
 */
class ArticleHolder extends Page
{
    private static $allowed_children = [
        ArticlePage::class
    ];

    private static array $has_many = [
      'Categories' => ArticleCategory::class,
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Categories', GridField::create(
            'Categories',
            'Article categories',
            $this->Categories(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}
