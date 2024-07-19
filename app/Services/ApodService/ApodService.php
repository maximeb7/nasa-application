<?php

namespace App\Services\ApodService;



use App\Dtos\ApodDto;
use App\Interfaces\Nasa\NasaInterface;
use App\Services\NasaService;
use Illuminate\Support\Facades\Http;

class ApodService
{
    protected  $nasaService;

    public function __construct(NasaInterface $nasaService)
    {
        $this->nasaService = $nasaService;
    }

    public function getApod(): ?ApodDto
    {
        try {
            $response = Http::get($this->nasaService->getApodUrl(), [
                'api_key' => $this->nasaService->getApiKey()
            ]);

            if ($response->successful()) {
                return ApodDto::fromApi($response->json());
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
