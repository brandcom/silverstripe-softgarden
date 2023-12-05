<?php

declare(strict_types=1);

use SilverStripe\Core\Environment;

/**
 * Unsere Brücke zu den Stellenanzeigen.
 */
class SoftgardenClient
{
    // TODO Pagination bei Softgarden

    private string $apiUrl = "https://api.softgarden.io/api/rest/v3/frontend/jobslist";
    private string $username;
    private string $password;
    private string $channelId;

    public function __construct()
    {
        $this->username = Environment::getEnv("SOFTGARDEN_API_KEY");
        $this->password = Environment::getEnv("SOFTGARDEN_API_Password");
        $this->channelId = Environment::getEnv("SOFTGARDEN_API_CHANNEL_ID");
    }

    public function getAllJobs(): array
    {
        $this->apiUrl = $this->apiUrl . "/" . $this->channelId;
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
