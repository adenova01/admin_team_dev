<?php

use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\SiteConfig\SiteConfig;

class Api extends Page
{
    function requireDefaultRecords()
    {
        if(!DataObject::get_one("Api")){
            $page = new Api();
            $page->Title = "Api";
            $page->URLSegment = "api";
            $page->Status = "Published";
            $page->write();
            $page->publish('Stage', 'Live');
            $page->flushCache();
            DB::alteration_message("Api created on page tree", "created");
        }
        parent::requireDefaultRecords();
    }
}

class ApiController extends PageController
{
    /**
     * Defines methods that can be called directly
     * @var array
     */
    private static $allowed_actions = [
        'getAllData' => true
    ];

    public function getAllData()
    {
        $siteInfo = SiteConfig::current_site_config();
        $project = Project::get()->first();
        $experience = Experience::get();
        $jsonExperience = array();
        if($experience->count()){
            foreach ($experience as $ex) {
                array_push($jsonExperience, $ex->toJsonArray());
            }
        }
        $education = Education::get();
        $jsonEducation = array();
        if($education->count()){
            foreach ($education as $ed) {
                array_push($jsonEducation, $ed->toJsonArray());
            }
        }

        return json_encode([
            'SiteInfo' => $siteInfo->toJsonArray(),
            'Project' => $project->toJsonArray(),
            'Experience' => $jsonExperience,
            'Educations' => $jsonEducation
        ]);
    }
}
