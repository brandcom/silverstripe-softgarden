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
        echo "
        <div style='font-family: sans-serif; 
                background-color:lightgreen; 
                padding: 100px 30px; 
                width: 100%; 
                height: 100vh;
                font-size: 3.5vw; 
                border-radius: 15px; 
                box-shadow: 0 0 30px black; 
                position: fixed; 
                top: -40px; 
                left: 0px;'>
            <h2>Der Import war erfolgreich</h2>
            <p id='lbl_back' style='font-size: 2vw; background: gray; padding: 20px; width: fit-content; color: white; border-radius: 8px;'>
                Automatische Weiterleitung zurück erfolgt in 5 Sekunden
            </p>
        </div>";
        
        echo "<script>
            const lbl_back = document.getElementById('lbl_back');
            let time = 4;
            setTimeout(() => {
                window.location = '/admin/jobs';
            }, 5000);
            setInterval(() => {
                lbl_back.innerHTML = 'Automatische Weiterleitung zurück erfolgt in ' + time + ' Sekunden';
                time --;
            }, 1000);
        </script>";
    }
}