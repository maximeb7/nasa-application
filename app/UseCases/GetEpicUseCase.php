<?php

namespace App\UseCases;

use App\Dtos\EpicDto;
use App\Services\EpicService\EpicService;

class GetEpicUseCase
{
    protected $epicService;

    public function __construct(EpicService $epicService)
    {
        $this->epicService = $epicService;
    }

    public function execute(string $day, string $month, string $year): ?EpicDto
    {
        return $this->epicService->getEpic($day, $month, $year);
    }
}
