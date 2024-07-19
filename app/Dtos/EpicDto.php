<?php

namespace App\Dtos;

use App\Services\NasaService;

class EpicDto
{
    public string $identifier;
    public string $caption;
    public string $image;
    public string $version;
    public array $centroidCoordinates;
    public array $dscovrJ2000Position;
    public array $lunarJ2000Position;
    public array $sunJ2000Position;
    public array $attitudeQuaternions;

    public string $date;
    public array $coords;
    public string $day;
    public string $month;
    public string $year;

    public function __construct(array $data)
    {
        $this->identifier = $data['identifier'] ?? '';
        $this->caption = $data['caption'];
        $this->image = $data['image'];
        $this->version = $data['version'];
        $this->centroidCoordinates = $data['centroid_coordinates'];
        $this->dscovrJ2000Position = $data['dscovr_j2000_position'];
        $this->lunarJ2000Position = $data['lunar_j2000_position'];
        $this->sunJ2000Position = $data['sun_j2000_position'];
        $this->attitudeQuaternions = $data['attitude_quaternions'];
        $this->date = $data['date'];
        $this->coords = $data['coords'];
        $this->day = $data['day'];
        $this->month = $data['month'];
        $this->year = $data['year'];
    }

    public static function fromApi(array $data): EpicDto
    {
        return new self($data);
    }

    public function toArray(): array
    {
        $nasaService = new NasaService();
        $epicArchiveUrl = $nasaService->getEpicArchive();
        $archive = "{$epicArchiveUrl}/{$this->year}/{$this->month}/{$this->day}/png/";
        $image = "{$this->image}.png";
        $source = $archive . $image;


        return [
            'identifier' => $this->identifier,
            'caption' => $this->caption,
            'image' => $this->image,
            'version' => $this->version,
            'source' => $source
        ];
    }
}
