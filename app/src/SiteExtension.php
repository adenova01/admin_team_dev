<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;

class SiteExtension extends DataExtension
{
    private static $db = [
        'MapsLinkIframe' => 'Text',
        'Phone' => 'Varchar',
        'Email' => 'Varchar'
    ];

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab("Root.Main", [
            TextField::create("MapsLinkIframe","Iframe Maps"),
            TextField::create("Phone"),
            TextField::create("Email"),
        ]);
        return $fields;
    }

    public function toJsonArray()
    {
        $siteConfig = SiteConfig::current_site_config();
        $arr = array();
        $arr['Title'] = $siteConfig->Title;
        $arr['MapsURL'] = $siteConfig->MapsLinkIframe;
        $arr['Phone'] = $siteConfig->Phone;
        $arr['Email'] = $siteConfig->Email;
        return $arr;
    }
}
