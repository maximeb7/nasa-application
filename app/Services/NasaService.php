<?php

namespace App\Services;

use App\Interfaces\Nasa\NasaInterface;
use Illuminate\Support\Facades\Http;

class NasaService implements NasaInterface
{
    protected string $apiKey;
    protected string $apodUrl;

    public function __construct()
    {
        $this->apiKey = config('services.nasa.api_key');
        $this->apodUrl = config('services.nasa.apod_url');
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApodUrl(): string
    {
        return $this->apodUrl;
    }
}
