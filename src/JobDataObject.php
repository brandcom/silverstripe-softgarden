<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

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
 * @property string|null $postingLastUpdatedDate
 * @property string $project_number
 * @property string|null $employmentTypes
 * @property string $industries
 * @property string $internalJobAdText
 * @property string $remote_status
 * @property string $keywords
 * @property string|null $workTimes
 * @property string|null $workExperiences
 */
class JobDataObject extends DataObject
{
    private static $table_name = 'BrandcomSoftgardenJobDataObject';

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
        "postingLastUpdatedDate" => "Varchar",
        "project_number" => "Varchar",
        "employmentTypes" => "Varchar",
        "industries" => "Varchar",
        "internalJobAdText" => "Varchar",
        "remote_status" => "Varchar",
        "keywords" => "Varchar",
        "workTimes" => "Varchar",
        "workExperiences" => "Varchar",
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
        foreach ($jobs["results"] as $job) {
            $jobDataObject = new JobDataObject();

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
            $jobDataObject->jobAdText = isset($job["jobAdText"]) ? strip_tags($job["jobAdText"], ['<ul>', '<li>', '<p>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>' ]) : null;
            if (isset($job["jobStartDate"])) {
                $formattedStartDate = self::convertToDate($job["jobStartDate"], 'startdate');
                $jobDataObject->jobStartDate = $formattedStartDate;
            } else {
                $jobDataObject->jobStartDate = null;
            }
            $jobDataObject->job_ad_url = isset($job["job_ad_url"]) ? $job["job_ad_url"] : null;
            if (isset($job["postingLastUpdatedDate"])) {
                $formattedDate = self::convertToDate($job["postingLastUpdatedDate"], 'lastupdate');
                $jobDataObject->postingLastUpdatedDate = $formattedDate;
            } else {
                $jobDataObject->postingLastUpdatedDate = null;
            }
            $jobDataObject->project_number = isset($job["project_number"]) ? $job["project_number"] : null;
            if (isset($job["employmentTypes"])) {
                $empType = implode(",", $job["employmentTypes"]);
                switch ($empType) {
                    case "1":
                        $empType = "Arbeitnehmerüberlassung";
                        break;
                    case "2":
                        $empType = "Ausbildung, Studium";
                        break;
                    case "3":
                        $empType = "Bachelor-/Master-/Diplom-Arbeiten";
                        break;
                    case "4":
                        $empType = "Befristeter Vertrag";
                        break;
                    case "5":
                        $empType = "Berufseinstieg/Trainee";
                        break;
                    case "6":
                        $empType = "Feste Anstellung";
                        break;
                    case "7":
                        $empType = "Franchise";
                        break;
                    case "8":
                        $empType = "Freie Mitarbeit/Projektmitarbeit";
                        break;
                    case "9":
                        $empType = "Handelsvertreter";
                        break;
                    case "10":
                        $empType = "Praktikum";
                        break;
                    case "11":
                        $empType = "Promotion/Habilitation";
                        break;
                    case "12":
                        $empType = "Referendariat";
                        break;
                    case "13":
                        $empType = "Studentenjobs, Werkstudent";
                        break;
                    default:
                        $empType = "-";
                        break;
                }
                $jobDataObject->employmentTypes = $empType;
            } else {
                $jobDataObject->employmentTypes = null;
            }
            $jobDataObject->industries = isset($job["industries"]) ? implode(",", $job["industries"]) : null;
            $jobDataObject->internalJobAdText = isset($job["internalJobAdText"]) ? $job["internalJobAdText"] : null;
            $jobDataObject->remote_status = isset($job["remote_status"]) ? $job["remote_status"] : null;
            $jobDataObject->keywords = isset($job["keywords"]) ? $job["keywords"] : null;
            // Arbeitszeit
            if (isset($job["workTimes"])) {
                $workTimeType = implode(",", $job["workTimes"]);
                switch ($workTimeType) {
                    case "799eb9d2c0bc4e7490fde05f847b331a":
                        $workTimeType = "Teilzeit";
                        break;
                    case "137caf67764c4b63b0272895af1704b0":
                        $workTimeType = "Vollzeit";
                        break;
                    case "87af1987840d4442b87f2e0ee3344a1f":
                        $workTimeType = "Voll- oder Teilzeit";
                        break;
                    case "ebc0523b259945e3b633d88428a3ce7a":
                        $workTimeType = "Freie Mitarbeit/Projektmitarbeit";
                        break;                    
                    default:
                        $workTimeType = "-";
                        break;
                }
                $jobDataObject->workTimes = $workTimeType;
            } else {
                $jobDataObject->workTimes = null;
            }

            //Berufserfahrung
            if (isset($job["workExperiences"])) {
                $workExperType = implode(",", $job["workExperiences"]);
                switch ($workExperType) {
                    case "1b4f51fe628c4119a2d7a581557d0944":
                        $workExperType = "Mit Berufserfahrung";
                        break;
                    case "12df74fc98fc48aba84b99927db3d82d":
                        $workExperType = "Mit Leitungsfunktion";
                        break;
                    case "0a01c25fd9e34663bf4464094e648090":
                        $workExperType = "Ohne Berufserfahrung";
                        break;                  
                    default:
                        $workExperType = "-";
                        break;
                }
                $jobDataObject->workExperiences = $workExperType;
            } else {
                $jobDataObject->workExperiences = null;
            }


            $jobDataObject->write();
        }
    }

    private function convertToDate(int $tmestmp, string $datetype): string
    {
        $lastUpdatedDateMilliseconds = $tmestmp;
        $seconds = $lastUpdatedDateMilliseconds / 1000;
        $date = new \DateTime("@$seconds");
        if($datetype == 'startdate') {
            $formattedDte = $date->format("d.m.Y");
        }else {
            $formattedDte = $date->format("Y-m-d");
        }
        
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
