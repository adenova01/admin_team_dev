<?php

use SilverStripe\Assets\Image;

class ProjectImages extends Image
{
    /**
     * Has_one relationship
     * @var array
     */
    private static $has_one = [
        'Project' => Project::class,
    ];
}
