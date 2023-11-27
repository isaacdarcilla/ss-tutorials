<?php

namespace SilverStripe\Lessons;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

/**
 * @method Regions()
 */
class Region extends DataObject
{
    private static bool $versioned_gridfield_extensions = true;

    private static array $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
    ];

    private static array $has_one = [
        'Photo' => Image::class,
        'RegionPage' => RegionsPage::class
    ];

    private static array $extensions = [
        Versioned::class,
    ];

    private static array $owns = [
        'Photo',
    ];

    private static array $summary_fields = [
        'Photo.Filename' => 'Photo file name',
        'Title' => 'Title of region',
        'Description' => 'Short description'
    ];

    public function getGridThumbnail()
    {
        if($this->Photo()->exists()) {
            return $this->Photo()->ScaleWidth(100);
        }

        return "(no image)";
    }

    public function getCMSFields(): FieldList
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            TextareaField::create('Description'),
            $uploader = UploadField::create('Photo')
        );

        $uploader->setFolderName('region-photos');
        $uploader->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);

        return $fields;
    }
}