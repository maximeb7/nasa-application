<?php

namespace App\Interfaces\Nasa;

interface NasaInterface
{
    public function getApiKey(): string;
    public function getApodUrl(): string;
}
