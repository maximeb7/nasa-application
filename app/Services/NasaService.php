<?php

namespace App\Services;

use App\Interfaces\Nasa\NasaInterface;
use Illuminate\Support\Facades\Http;

class NasaService implements NasaInterface
{
    protected string $apiKey;
    protected string $apodUrl;
    protected string $epicUrl;

    protected  string $epicArchiveUrl;
    protected string $marsRoverUrl;

    public function __construct()
    {
        $this->apiKey = config('services.nasa.api_key');
        $this->apodUrl = config('services.nasa.apod_url');
        $this->epicUrl = config('services.nasa.epic_url');
        $this->epicArchiveUrl = config('services.nasa.epic_archive_url');
        $this->marsRoverUrl = config('services.nasa.mars_rover_url');
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

    public function getEpicUrl(): string
    {
        return $this->epicUrl;
    }

    public function getEpicArchive(): string
    {
        return $this->epicArchiveUrl;
    }

    public function getMarsRoverUrl(): string
    {
        return $this->marsRoverUrl;
    }
}
