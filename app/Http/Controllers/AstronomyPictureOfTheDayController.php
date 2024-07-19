<?php

namespace App\Http\Controllers;

use App\UseCases\GetApodUseCase;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApodResource;

class AstronomyPictureOfTheDayController extends Controller
{

    protected $getApodUseCase;

    /**
     * Constructor to inject dependencies.
     *
     * @param GetApodUseCase $getApodUseCase
     */
    public function __construct(GetApodUseCase $getApodUseCase)
    {
        $this->getApodUseCase = $getApodUseCase;
    }

    public function __invoke(): JsonResponse
    {
        $apodDTO = $this->getApodUseCase->execute();

        if ($apodDTO === null) {
            return response()->json(['error' => 'Failed to retrieve APOD data.'], 500);
        }

        return response()->json($apodDTO->toArray());
    }
}
