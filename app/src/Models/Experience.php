<?php

use SilverStripe\ORM\DataObject;

class Experience extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
        'Years' => 'Int'
    ];

    public function toJsonArray()
    {
        $arr = array();
        $arr['Title'] = $this->Title;
        $arr['Description'] = $this->Description;
        $arr['Years'] = $this->Years;
        return $arr;
    }
}
