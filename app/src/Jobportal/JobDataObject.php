<?php

declare(strict_types=1);

use SilverStripe\ORM\DataObject;

/**
 * Repräsentiert eine Stellenanzeige und hat ähnliche $db-Felder, wie
 * die Jobs in der API
 * @property int $jobDbId
 * @property string $externalPostingName
 * @property string $applyOnlineLink
 * @property string $company_id
 * @property string $company_name
 * @property string $geo_city
 * @property string $geo_country
 * @property string $geo_lat
 * @property string $geo_long
 * @property string $geo_name
 * @property string $geo_state
 * @property string $geo_street
 * @property string $geo_zip
 * @property string $locale
 * @property string $jobAdText
 * @property string|null $jobStartDate
 * @property string $job_ad_url
 * @property string $job_owner_email
 * @property string $job_owner_firstname
 * @property string $job_owner_lastname
 * @property string $job_owner_salutation
 * @property string $job_owner_avatarurl
 * @property string|null $postingLastUpdatedDate
 * @property string $project_number
 * @property string $employmentTypes
 * @property string $industries
 * @property string $internalJobAdText
 * @property string $remote_status
 * @property string $keywords
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
        "jobStartDate" => "Varchar",
        "job_ad_url" => "Varchar",
        "job_owner_email" => "Varchar",
        "job_owner_firstname" => "Varchar",
        "job_owner_lastname" => "Varchar",
        "job_owner_salutation" => "Varchar",
        "job_owner_avatarurl" => "Varchar",
        "postingLastUpdatedDate" => "Varchar",
        "project_number" => "Varchar",
        "employmentTypes" => "Varchar",
        "industries" => "Varchar",
        "internalJobAdText" => "Varchar",
        "remote_status" => "Varchar",
        "keywords" => "Varchar",
    ];

    private string $companyName;

    public function saveJobs(array $jobs): void
    {
        // Lösche die gespeicherten Jobs zuerst
        $joblist = JobDataObject::get();
        foreach ($joblist as $item) {
            $item->delete();
        }

        //Die Ergebnisse durchlaufen und JobDataObjects erstellen
        //TODO -  Datumswerte konvertieren
        //TODO - Anrede

        foreach ($jobs["results"] as $job) {
            $jobDataObject = new JobDataObject();
            var_dump($job);
            $companyName = $job["company_name"];

            $jobDataObject->jobDbId = isset($job["jobDbId"]) ? $job["jobDbId"] : null;
            $jobDataObject->externalPostingName = isset($job["externalPostingName"])
                ? $job["externalPostingName"]
                : null;
            $jobDataObject->applyOnlineLink = isset($job["applyOnlineLink"]) ? $job["applyOnlineLink"] : null;
            $jobDataObject->company_id = isset($job["company_id"]) ? $job["company_id"] : null;
            $jobDataObject->company_name = isset($companyName) ? $companyName : null;
            $jobDataObject->geo_city = isset($job["geo_city"]) ? $job["geo_city"] : null;
            $jobDataObject->geo_country = isset($job["geo_country"]) ? $job["geo_country"] : null;
            $jobDataObject->geo_lat = isset($job["geo_lat"]) ? $job["geo_lat"] : null;
            $jobDataObject->geo_long = isset($job["geo_long"]) ? $job["geo_long"] : null;
            $jobDataObject->geo_name = isset($job["geo_name"]) ? $job["geo_name"] : null;
            $jobDataObject->geo_state = isset($job["geo_state"]) ? $job["geo_state"] : null;
            $jobDataObject->geo_street = isset($job["geo_street"]) ? $job["geo_street"] : null;
            $jobDataObject->geo_zip = isset($job["geo_zip"]) ? $job["geo_zip"] : null;
            $jobDataObject->locale = isset($job["locale"]) ? $job["locale"] : null;
            $jobDataObject->jobAdText = isset($job["jobAdText"]) ? $job["jobAdText"] : null;
            if (isset($job["jobStartDate"])) {
                $formattedStartDate = self::convertToDate($job["jobStartDate"]);
                $jobDataObject->jobStartDate = $formattedStartDate;
            } else {
                $jobDataObject->jobStartDate = null;
            }
            $jobDataObject->job_ad_url = isset($job["job_ad_url"]) ? $job["job_ad_url"] : null;
            $jobDataObject->job_owner_email = isset($job["job_owner_email"]) ? $job["job_owner_email"] : null;
            $jobDataObject->job_owner_firstname = isset($job["job_owner_firstname"])
                ? $job["job_owner_firstname"]
                : null;
            $jobDataObject->job_owner_lastname = isset($job["job_owner_lastname"]) ? $job["job_owner_lastname"] : null;
            $jobDataObject->job_owner_salutation = isset($job["job_owner_salutation"])
                ? $job["job_owner_salutation"]
                : null;
            $jobDataObject->job_owner_avatarurl = isset($job["job_owner_avatarurl"])
                ? $job["job_owner_avatarurl"]
                : null;
            if (isset($job["postingLastUpdatedDate"])) {
                $formattedDate = self::convertToDate($job["postingLastUpdatedDate"]);
                $jobDataObject->postingLastUpdatedDate = $formattedDate;
            } else {
                $jobDataObject->postingLastUpdatedDate = null;
            }
            $jobDataObject->project_number = isset($job["project_number"]) ? $job["project_number"] : null;
            $jobDataObject->employmentTypes = isset($job["employmentTypes"])
                ? implode(",", $job["employmentTypes"])
                : null;
            $jobDataObject->industries = isset($job["industries"]) ? implode(",", $job["industries"]) : null;
            $jobDataObject->internalJobAdText = isset($job["internalJobAdText"]) ? $job["internalJobAdText"] : null;
            $jobDataObject->remote_status = isset($job["remote_status"]) ? $job["remote_status"] : null;
            $jobDataObject->keywords = isset($job["keywords"]) ? $job["keywords"] : null;

            $jobDataObject->write();
        }
    }

    private function convertToDate(int $tmestmp): string
    {
        $lastUpdatedDateMilliseconds = $tmestmp;
        $seconds = $lastUpdatedDateMilliseconds / 1000;
        $date = new DateTime("@$seconds");
        $formattedDte = $date->format("d.m.Y-H:i");
        return $formattedDte;
    }

    private static array $summary_fields = [
        "ID" => "ID",
        "jobDbId" => "Job ID",
        "externalPostingName" => "Job Titel",
        "company_name" => "Firmenname",
        "geo_name" => "Ort",
        "geo_state" => "Bundesland",
    ];
}
