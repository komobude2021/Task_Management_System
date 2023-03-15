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
            $response = $this->client->request('GET', 'https://api.github.com/users/' . $username . '/repos', [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                ],
            ]);
            return json_decode($response->getBody());
        } catch (Exception $e) {
            return false;
        }
    }
}
