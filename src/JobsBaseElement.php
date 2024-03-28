<?php

namespace brandcom\Softgarden;

use SilverStripe\ORM\DataList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;

class JobsBaseElement extends \BaseElement
{
    private static $table_name = 'BrandcomSoftgardenJobsBaseElement';

    private static $singular_name = "Softgarden Jobs";

    private static $description = "Fügt ein Element ein, welches alle verfügbaren Jobs anzeigt.";

    private static $icon = "font-icon-block-table-data";

    private static $inline_editable = false;

 

    private static $db = [
        "Headline" => "Varchar(255)",
        "EmploymentTypeFilter" => "Varchar(255)",
        "ShowDropdown" => "Boolean"
    ];

    //* Get all Jobs from the Softgarden API
    public function getAllSoftgardenJobs(): DataList
    {
        $heutigesDatum = date('Y-m-d');
        $jobs = JobDataObject::get();

        foreach ($jobs as $job) {
            $jobStartDate = $job->jobStartDate;

            // Überprüfe, ob das jobStartDate älter als das heutige Datum ist
            if ($jobStartDate && strtotime($jobStartDate) < strtotime($heutigesDatum)) {
                // Setze "sofort" als Wert für jobStartDate
                $job->jobStartDate = 'sofort';
                $job->write();
            }
        }

        return $jobs;
    }

    //* Filters the jobs based on the employmentType
    function getFilteredSoftgardenJobs($filter_arg)
    {
        $jobs = $this->getAllSoftgardenJobs();
        if($filter_arg == 'all')
        {
            return $jobs;
        }
        $filteredJobs = $jobs->filter('employmentTypes', $filter_arg);
        return $filteredJobs;
    }


    //* Get CMS Fields
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab("Root.Main", new TextField("Headline", "Überschrift"), "Content");
        
        $fields->addFieldToTab("Root.Main", new DropdownField("EmploymentTypeFilter", "Vorab filtern nach Beschäftigungsart", array(
            "all" => "Alle",
            "Feste Anstellung" => "Vollzeit",
            "Ausbildung, Studium" => "Ausbildung",
        )), "Content");

        $fields->addFieldToTab("Root.Main", new DropdownField("ShowDropdown", "Dropdown zum Filtern der Anstellungsart anzeigen (Nur wenn Vorabfilter auf 'Alle' gesetzt ist und nur bei einem BaseElement pro Seite)" , array(
            "1" => "Ja",
            "0" => "Nein",
        )), "Content");

        return $fields;
    }

    
    public function forTemplate($holder = true)
    {
        return $this->renderWith("BaseElements/JobsBaseElement");
    }
    

    /**
     * Gibt den Namen des BaseElements für die Auswahl im CMS zurück.
     */
    public function getType(): string
    {
        return "Softgarden Job Übersicht";
    }    
}
