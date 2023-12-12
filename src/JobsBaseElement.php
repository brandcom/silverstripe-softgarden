<?php

namespace brandcom\Softgarden;

use SilverStripe\ORM\DataList;

class JobsBaseElement extends \BaseElement
{
    private static $table_name = 'BrandcomSoftgardenJobsBaseElement';

    private static $singular_name = "Softgarden Jobs";

    private static $description = "Fügt ein Element ein, welches alle verfügbaren Jobs anzeigt.";

    private static $icon = "font-icon-block-table-data";

    private static $inline_editable = false;

 

    private static $db = [
        "Headline" => "Varchar(255)",
    ];

    public function getAllSoftgardenJobs(): DataList
    {
        return JobDataObject::get();
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
