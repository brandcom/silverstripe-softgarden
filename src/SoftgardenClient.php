<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Core\Environment;

/**
 * Unsere Brücke zu den Stellenanzeigen.
 */
class SoftgardenClient
{

    private string $apiUrl = "https://api.softgarden.io/api/rest/v3/frontend/jobslist";
    private array $usernames = [];
    private string $password;
    private array $channelIds = [];

    public function __construct()
    {
        $this->password = Environment::getEnv("SOFTGARDEN_API_Password");
        $fetchFromEnv = true;
        $i = 0;

        while ($fetchFromEnv) {
            $i++;
            
            if (
                Environment::getEnv('SOFTGARDEN_API_KEY'.$i) !== false
                && Environment::getEnv('SOFTGARDEN_API_CHANNEL_ID'.$i) !== false
            ) {
                $this->usernames[] = Environment::getEnv('SOFTGARDEN_API_KEY'.$i);
                $this->channelIds[] = Environment::getEnv('SOFTGARDEN_API_CHANNEL_ID'.$i);
            } else {
                $fetchFromEnv = false;

                // Failsafe for backwards compatibility
                if ($i == 1 && Environment::getEnv('SOFTGARDEN_API_KEY') !== false) {
                    $this->usernames[] = Environment::getEnv('SOFTGARDEN_API_KEY');
                    $this->channelIds[] = Environment::getEnv('SOFTGARDEN_API_CHANNEL_ID');
                }
            }
        }
    }

    public function getAllJobs(): array
    {
        $allJobs = [];

        foreach ($this->usernames as $key => $username) {
            $channelId = $this->channelIds[$key];

            $url = $this->apiUrl . "/" . $channelId;
    
            $ch = curl_init($url);
    
            $headers = ["Content-Type: application/json"];
    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $this->password);
    
            $result = curl_exec($ch);
            $jobs = json_decode($result, true);
    
            curl_close($ch);

            if (is_array($jobs) && array_key_exists('results', $jobs)) {   
                foreach ($jobs['results'] as $key => $job) {
                    $job['channelId'] = $channelId;
                    $allJobs[] = $job;
                }
            }
        }

        return $allJobs;
    }
}
