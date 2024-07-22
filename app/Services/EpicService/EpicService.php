<?php

namespace App\Services\EpicService;

use App\Dtos\EpicDto;
use App\Interfaces\Nasa\NasaInterface;


class EpicService
{
    protected $nasaService;

    public function __construct(NasaInterface $nasaService)
    {
        $this->nasaService = $nasaService;
    }

    /**
     * @param string $day
     * @param string $month
     * @param string $year
     * @return EpicDto|null
     */
    public function getEpic(string $day, string $month, string $year): EpicDto|string
    {
        $epicUrl = $this->nasaService->getEpicUrl();

        $dayEpicUrl = "{$epicUrl}/{$year}-{$month}-{$day}";
        $meta = file_get_contents($dayEpicUrl);

        $response = json_decode($meta, true);

        if (empty($response)) {
            return "";
        }
        $arrayFormated = $this->addDaysInformations($response[0], $day, $month, $year);


        return EpicDto::fromApi($arrayFormated);
    }

    /**
     * @param array $data
     * @param string $day
     * @param string $month
     * @param string $year
     * @return array
     */
    private function addDaysInformations(array $data, string $day, string $month, string $year): array
    {
        $data['day'] = $day;
        $data['month'] = $month;
        $data['year'] = $year;

        return $data;
    }
}
