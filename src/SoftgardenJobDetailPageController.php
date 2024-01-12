<?php

namespace brandcom\Softgarden;
use SilverStripe\View\Requirements;

class SoftgardenJobDetailPageController extends \PageController
{
    private static $allowed_actions = ["showjob"];

    protected function init()
    {
        parent::init();
        Requirements::css('/_resources/vendor/brandcom/silverstripe-softgarden/client/dist/softgardenstyles.css');
        Requirements::javascript('/_resources/vendor/brandcom/silverstripe-softgarden/client/dist/softgardenscripts.js');
    }



    public function showjob($request)
    {
        $jobID = $request->param("ID");

        $job = JobDataObject::get()->filter('jobDbId', $jobID)->first();     
        
        if (!$job || !$job->exists()) {
            return $this->httpError(404, 'Job nicht gefunden');
        }

        // $this->getBenefitsJson();

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

}