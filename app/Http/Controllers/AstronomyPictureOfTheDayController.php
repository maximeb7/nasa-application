<?php

namespace App\Http\Controllers;

use App\Services\ApodService\ApodService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApodResource;

class AstronomyPictureOfTheDayController extends Controller
{

    protected $apodService;

    public function __construct(ApodService $apodService)
    {
        $this->apodService = $apodService;
    }

    public function index(): JsonResponse
    {
        $apodDTO = $this->apodService->getApod();

        if ($apodDTO === null) {
            return response()->json(['error' => 'Failed to retrieve APOD data.'], 500);
        }

        return new JsonResponse(new ApodResource($apodDTO));
    }
}
