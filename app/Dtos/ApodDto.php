<?php

namespace App\Dtos;

class ApodDto
{
    public string $copyright;
    public string $date;
    public string $explanation;
    public string $hdurl;
    public string $media_type;
    public string $service_version;
    public string $title;
    public string $url;

    public function __construct(array $data)
    {
        $this->copyright = $data['copyright'] ?? '';
        $this->date = $data['date'];
        $this->explanation = $data['explanation'];
        $this->hdurl = $data['hdurl'];
        $this->media_type = $data['media_type'];
        $this->service_version = $data['service_version'];
        $this->title = $data['title'];
        $this->url = $data['url'];
    }

    public static function fromApi(array $data): ApodDTO
    {
        return new self($data);
    }
}
