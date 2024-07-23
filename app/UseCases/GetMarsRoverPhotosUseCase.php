<?php

namespace App\UseCases;


use App\Dtos\MarsPhotosDto;
use App\Services\MarsRoverPhotosService\MarsRoverPhotosService;

class GetMarsRoverPhotosUseCase
{
    protected $marsRoverPhotosService;

    public function __construct(MarsRoverPhotosService $marsRoverPhotosService)
    {
        $this->marsRoverPhotosService = $marsRoverPhotosService;
    }

    public function execute(string $day, string $month, string $year): ?MarsPhotosDto
    {
        return $this->marsRoverPhotosService->getPhotos($day, $month, $year);
    }
}
