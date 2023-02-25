<?php

use SilverStripe\Control\Director;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataObject;

class Project extends DataObject
{
    private static $db = [
        'Title' => 'Varchar'
    ];

    /**
     * Has_many relationship
     * @var array
     */
    private static $has_many = [
        'ProjectImages' => ProjectImages::class,
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("ProjectImages");
        $fields->addFieldToTab("Root.Main", $imageUpload = UploadField::create("ProjectImages"));
        $imageUpload->setFolderName('ProjectImage');
        $imageUpload->getValidator()->setAllowedExtensions(['jpg','png','jpeg']);
        return $fields;
    }

    /**
     * Event handler called before writing to the database.
     *
     * @uses DataExtension->onAfterWrite()
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        foreach ($this->ProjectImages() as $key => $value) {
            if($value->exists() && !$value->isPublished())
            {
                $value->doPublish();
            }
        }
    }

    public function toJsonArray()
    {
        $arr = array();
        $arr['Title'] = $this->Title;
        $arr['ProjectImages'] = [];
        if($this->ProjectImages()->count()){
            foreach ($this->ProjectImages() as $value) {
                array_push($arr['ProjectImages'], $value->AbsoluteURL);
            }
        }
        return $arr;
    }
}
