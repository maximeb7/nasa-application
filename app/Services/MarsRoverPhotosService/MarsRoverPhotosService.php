<?php

namespace App\Services\MarsRoverPhotosService;

use App\Dtos\MarsPhotosDto;
use App\Interfaces\Nasa\NasaInterface;
use App\Services\NasaService;
use Illuminate\Support\Facades\Http;

class MarsRoverPhotosService extends NasaService
{
    protected $nasaService;

    public function __construct(NasaInterface $nasaService)
    {
        $this->nasaService = $nasaService;
    }

    public function getPhotos(string $day, string $month, string $year): ?MarsPhotosDto
    {
        try {
            $response = Http::get($this->nasaService->getMarsRoverUrl(), [
                'api_key' => $this->nasaService->getApiKey(),
                'earth_date' => $year . '-' . $month . '-' . $day,
            ]);
            if ($response->successful() && !empty($response->json()['photos'])) {
                return MarsPhotosDto::fromApi($response->json()['photos'][0]);
            } else {
                Log::error('NASA API returned an error: ' . $response->status());
                return null;
            }
        } catch (RequestException $e) {
            Log::error('Request to NASA API failed: ' . $e->getMessage());
            return null;
        } catch (Exception $e) {
            Log::error('An unexpected error occurred: ' . $e->getMessage());
            return null;
        }
    }
}
