<?php

declare(strict_types=1);

use SilverStripe\ORM\DataObject;

/**
 * Repräsentiert eine Stellenanzeige und hat ähnliche $db-Felder, wie
 * die Jobs in der API
 */
class JobDataObject extends DataObject
{
    private static array $db = [
        "jobDbId" => "Int",
        "externalPostingName" => "Varchar",
        "applyOnlineLink" => "Text",
        "company_id" => "Varchar",
        "company_name" => "Varchar",
        "geo_city" => "Varchar",
        "geo_country" => "Varchar",
        "geo_lat" => "Varchar",
        "geo_long" => "Varchar",
        "geo_name" => "Varchar",
        "geo_state" => "Varchar",
        "geo_street" => "Varchar",
        "geo_zip" => "Varchar",
        "locale" => "Varchar",
        "jobAdText" => "Text",
        "jobStartDate" => "Int",
        "job_ad_url" => "Varchar",
        "job_owner_email" => "Varchar",
        "job_owner_firstname" => "Varchar",
        "job_owner_lastname" => "Varchar",
        "job_owner_salutation" => "Varchar",
        "job_owner_avatarurl" => "Varchar",
        "postingLastUpdatedDate" => "Int",
        "project_number" => "Varchar",
        "employmentTypes" => "Varchar",
        "industries" => "Varchar",
        "internalJobAdText" => "Varchar",
        "remote_status" => "Varchar",
        "keywords" => "Varchar",
    ];

    private static array $summary_fields = [
        "jobDbId" => "Job ID",
        "externalPostingName" => "Job Titel",
        "geo_name" => "Ort",
        "geo_state" => "Bundesland",
    ];
}
