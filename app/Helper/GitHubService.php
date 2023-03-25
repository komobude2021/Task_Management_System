<?php

namespace App\Helper;

use Exception;
use GuzzleHttp\Client;

class GitHubService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getUserRepositories($username)
    {
        try {
            $username = urlencode($username);
            $response = $this->client->request('GET', "https://api.github.com/users/{$username}/repos?sort=created&direction=desc", [
                'headers' => ['Accept' => 'application/vnd.github.v3+json'],
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return false;
        }
    }
}
