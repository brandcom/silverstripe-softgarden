<?php

namespace brandcom\Softgarden;

class SoftgardenJobDetailPageController extends \PageController
{
    private static $allowed_actions = ["showjob"];

    public function showjob($request)
    {
        $jobID = $request->param("ID");
    
        if (is_numeric($jobID)) {
            $job = JobDataObject::get()->byID($jobID);
    
            if ($job && $job->exists()) {
                return $this->customise(['Jobdetail' => $job])->renderWith(['SoftgardenJobDetailPage', 'Page']);
            } else {
                return $this->httpError(404, 'Job nicht gefunden');
            }
        } else {
            return $this->httpError(400, 'Ungültige Job-ID');
        }
    }
    
}