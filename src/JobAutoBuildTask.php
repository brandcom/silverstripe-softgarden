<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;

/**
 * Ist dafür zuständig die Stellenanzeigen aus der API zu ziehen und in der
 * Silverstripe-DB abzuspeichern.
 * Wird mit Cronjobs getriggert.
 */

class JobAutoBuildTask extends BuildTask
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
    }
}