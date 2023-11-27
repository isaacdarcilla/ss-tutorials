<?php

namespace SilverStripe\Lessons;

use Page;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;

/**
 * @method Categories()
 */
class ArticlePage extends Page
{
    private static bool $can_be_root = false;

    private static array $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'Author' => 'Varchar',
    ];

    private static array $has_one = [
        'Photo' => Image::class,
        'Brochure' => File::class
    ];

    private static array $many_many = [
        'Categories' => ArticleCategory::class,
    ];

    // It would be nice if when we published the article, any attached files became implicitly published as well.
    // For that, we need to declare ownership of the files to ensure they receive publication by association.
    private static array $owns = [
        'Photo',
        'Brochure',
    ];

    public function CategoriesList(): ?string
    {
        if($this->Categories()->exists()) {
            return implode(', ', $this->Categories()->column('Title'));
        }

        return null;
    }

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', DateField::create('Date', 'Date of article'), 'Content');
        $fields->addFieldToTab(
            'Root.Main',
            TextareaField::create('Teaser')
                ->setDescription('This is the summary that appears on the article list page.'),
            'Content'
        );
        $fields->addFieldToTab('Root.Main', TextField::create('Author', 'Author of article'), 'Content');

        $fields->addFieldToTab('Root.Attachments', $photo = UploadField::create('Photo'));
        $fields->addFieldToTab(
            'Root.Attachments',
            $brochure = UploadField::create('Brochure', 'Travel brochure, optional (PDF only)')
        );

        $fields->addFieldToTab(
            'Root.Categories',
            CheckboxSetField::create(
                'Categories',
                'Selected categories',
                $this->Parent()->Categories()->map('ID', 'Title')
            )
        );

        $photo->setFolderName('travel-photos');
        $brochure
            ->setFolderName('travel-brochures')
            ->getValidator()->setAllowedExtensions(array('pdf'));

        return $fields;
    }
}
