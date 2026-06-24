<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Ist dafür zuständig die Stellenanzeigen aus der API zu ziehen und in der
 * Silverstripe-DB abzuspeichern.
 * Wird mit Cronjobs getriggert.
 */

class JobAutoBuildTask extends BuildTask
{
    protected static string $commandName = 'softgarden-auto-build';

    protected string $title = 'Softgarden: Auto-Import';

    protected static string $description = 'Importiert Stellenanzeigen aus der Softgarden-API in die Silverstripe-Datenbank (für Cronjobs).';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $client = new SoftgardenClient();
        $jobs = $client->getAllJobs();
        $newJobDataObject = new JobDataObject();
        $newJobDataObject->saveJobs($jobs);

        return Command::SUCCESS;
    }
}
