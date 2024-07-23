<?php

namespace App\Dtos;

class MarsPhotosDto
{
    public string $id;
    public string $sol;
    public array $camera;
    public string $imgSrc;
    public string $earthDate;
    public array $rover;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->sol = $data['sol'];
        $this->camera = $data['camera'];
        $this->imgSrc = $data['img_src'];
        $this->earthDate = $data['earth_date'];
        $this->rover = $data['rover'];
    }

    public static function fromApi(array $data): MarsPhotosDto
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sol' => $this->sol,
            'camera' => $this->camera,
            'img_src' => $this->imgSrc,
            'earth_date' => $this->earthDate,
            'rover' => $this->rover,
        ];
    }

}
