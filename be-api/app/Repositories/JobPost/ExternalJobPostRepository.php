<?php

namespace App\Repositories\JobPost;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ExternalJobPostRepository implements JobPostRepositoryInterface
{
    private string $externalApiUrl = 'https://mrge-group-gmbh.jobs.personio.de';
    private string $fetchAllEndpoint = '/xml';

    /**
     * @throws ConnectionException
     */
    public function all(): array
    {
        $url = $this->externalApiUrl . $this->fetchAllEndpoint;

        $response = Http::get($url);
        $xmlString = $response->getBody()->getContents();
        $xml = simplexml_load_string($xmlString);

        return json_decode(json_encode($xml), true);
    }

    /**
     * @throws ConnectionException
     */
    public function find(int $id): array
    {
        $url = $this->externalApiUrl . $this->fetchAllEndpoint;

        $response = Http::get($url);
        $xmlString = $response->getBody()->getContents();
        $xml = simplexml_load_string($xmlString);

        $jobPosts = json_decode(json_encode($xml), true);

        foreach ($jobPosts['position'] as $jobPost) {
            if ((int) $jobPost['id'] === $id) {
                return $jobPost;
            }
        }

        return [];
    }
}
