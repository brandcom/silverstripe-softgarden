<?php

declare(strict_types=1);

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;

/**
 * Ist dafür zuständig die Stellenanzeigen aus der API zu siehen und in der
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
        // beispiel
        // $client = new SoftgardenClient();
        // $jobs = $client->getAllJobs();
    }
}
