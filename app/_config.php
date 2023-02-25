<?php

use SilverStripe\Admin\CMSMenu;
use SilverStripe\Admin\SecurityAdmin;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\CampaignAdmin\CampaignAdmin;
use SilverStripe\CMS\Controllers\CMSPagesController;
use SilverStripe\Reports\ReportAdmin;
use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\VersionedAdmin\ArchiveAdmin;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);


CMSMenu::remove_menu_class(ArchiveAdmin::class);
CMSMenu::remove_menu_class(ReportAdmin::class);
// CMSMenu::remove_menu_class(AssetAdmin::class);
CMSMenu::remove_menu_class(CampaignAdmin::class);
CMSMenu::remove_menu_class(CMSPagesController::class);
CMSMenu::remove_menu_class(SecurityAdmin::class);

SiteConfig::add_extension(SiteExtension::class);

