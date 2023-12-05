<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;

/**
 * Ist dafür zuständig die Stellenanzeigen aus der API zu ziehen und in der
 * Silverstripe-DB abzuspeichern.
 */

class JobImportBuildTask extends BuildTask
{
    /**
     * Main-Method, die ausgeführt wird, wenn man den Task startet.
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function run($request)
    {
        $client = new SoftgardenClient();
        $jobs = $client->getAllJobs();
        $newJobDataObject = new JobDataObject();
        $newJobDataObject->saveJobs($jobs);

        //TODO DB löschen und neu importieren
        // Run: https://localhost:3000/dev/tasks/JobImportBuildTask
    }
}
