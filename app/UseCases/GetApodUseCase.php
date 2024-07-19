<?php

namespace App\UseCases;

use App\Services\ApodService\ApodService;
use App\DTOs\ApodDTO;
class GetApodUseCase
{
    protected $apodService;

    /**
     * Constructor to inject dependencies.
     *
     * @param ApodService $apodService
     */
    public function __construct(ApodService $apodService)
    {
        $this->apodService = $apodService;
    }

    /**
     * Execute the use case and return the APOD data.
     *
     * @return ApodDTO|null
     */
    public function execute(): ?ApodDTO
    {
        return $this->apodService->getApod();
    }
}
