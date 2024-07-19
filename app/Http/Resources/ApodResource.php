<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApodResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'copyright' => $this->copyright,
            'date' => $this->date,
            'explanation' => $this->explanation,
            'hdurl' => $this->hdurl,
            'media_type' => $this->media_type,
            'service_version' => $this->service_version,
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}
