<?php

namespace brandcom\Softgarden;

use SilverStripe\View\Requirements;
use SilverStripe\Core\Environment;

class SoftgardenJobDetailPageController extends \PageController
{
    private static $allowed_actions = ["showjob", "jobAutoImport"];

    protected function init()
    {
        parent::init();
        Requirements::css('./vendor/brandcom/silverstripe-softgarden/client/dist/softgardenstyles.css');
        Requirements::javascript('./vendor/brandcom/silverstripe-softgarden/client/dist/softgardenscripts.js');
    }

    public function showjob($request)
    {
        $jobID = $request->param("ID");

        $job = JobDataObject::get()->filter('jobDbId', $jobID)->first();     
        
        if (!$job || !$job->exists()) {
            return $this->httpError(404, 'Job nicht gefunden');
        }

        return ['Jobdetail' => $job];
    }


    public function getBenefitsJson(): string
	{
		$benefits = [];
		foreach(JobBenefitDataObj::get() as $benefit) {
			$benefits[] = [
                'benefit' => $benefit->Benefit,
				'benefit_icon_url' => $benefit->BenefitIcon()->Link()
            ];
		}

		return json_encode($benefits);
	}


    public function jobAutoImport($request): void
    {
        $requestedToken = Environment::getEnv("SOFTGARDEN_AUTO_BUILDTASK_TOKEN");
        $token = $request->requestVar("token");
        if($requestedToken == $token) {
            $task = new JobAutoBuildTask();
            $task->run($request);
        }
    }

}