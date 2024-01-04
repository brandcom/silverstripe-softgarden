<?php

namespace brandcom\Softgarden;

class SoftgardenJobDetailPageController extends \PageController
{
    private static $allowed_actions = ["showjob"];

    public function showjob($request)
    {
        $jobID = $request->param("ID");

        $job = JobDataObject::get()->filter('jobDbId', $jobID)->first();     
        
        if (!$job || !$job->exists()) {
            return $this->httpError(404, 'Job nicht gefunden');
        }

        return ['Jobdetail' => $job];
    }
}