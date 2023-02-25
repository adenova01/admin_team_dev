<?php

use SilverStripe\Admin\ModelAdmin;

class ProjectAdmin extends ModelAdmin
{
    private static $menu_title = "Project";
    private static $url_segment = "project";
    private static $managed_models = [
        Project::class
    ];
}
