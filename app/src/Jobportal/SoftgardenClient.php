<?php

declare(strict_types=1);

use SilverStripe\Core\Environment;

/**
 * Unsere Brücke zu den Stellenanzeigen.
 */
class SoftgardenClient
{
    // TODO Pagination bei Softgarden

    private string $apiUrl = "https://api.softgarden.io/api/rest/v3/frontend/jobslist/125411_extern";
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->username = Environment::getEnv("SOFTGARDEN_API_KEY");
        $this->password = Environment::getEnv("SOFTGARDEN_API_Password");
    }

    public function getAllJobs(): array
    {
        $url = $this->apiUrl;

        $ch = curl_init($url);

        $headers = ["Content-Type: application/json"];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);

        $result = curl_exec($ch);
        $jobs = json_decode($result, true);

        curl_close($ch);

        return $jobs;
    }
}
