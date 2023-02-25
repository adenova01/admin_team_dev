<?php

use SilverStripe\Admin\ModelAdmin;

class ExperieceAndEducationAdmin extends ModelAdmin
{
    private static $menu_title = "Experience & Education";
    private static $url_segment = "experience-education";
    private static $managed_models = [
        Experience::class,
        Education::class
    ];
}
