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
 */

class JobImportBuildTask extends BuildTask
{
    protected static string $commandName = 'softgarden-import';

    protected string $title = 'Softgarden: Import';

    protected static string $description = 'Importiert Stellenanzeigen aus der Softgarden-API in die Silverstripe-Datenbank (manuell über CMS-Button).';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $client = new SoftgardenClient();
        $jobs = $client->getAllJobs();
        (new JobDataObject())->saveJobs($jobs);

        $output->writeln(count($jobs) . ' Jobs erfolgreich importiert.');

        return Command::SUCCESS;
    }
}
