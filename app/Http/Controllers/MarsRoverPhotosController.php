<?php

namespace App\Http\Controllers;

use App\UseCases\GetMarsRoverPhotosUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarsRoverPhotosController extends Controller
{

    public function __construct(GetMarsRoverPhotosUseCase $getMarsRoverPhotosUseCase)
    {
        $this->getMarsRoverPhotos = $getMarsRoverPhotosUseCase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $day = $request->query('day');
        $month = $request->query('month');
        $year = $request->query('year');

        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            return response()->json(['error' => 'Invalid date parameters.'], 400);
        }

        $marsRoverPhotosDto = $this->getMarsRoverPhotos->execute($day, $month, $year);

        if ($marsRoverPhotosDto === null) {
            return response()->json(['error' => 'Failed to retrieve Mars photos data.'], 500);
        }

        return response()->json($marsRoverPhotosDto->toArray(), 200);
    }
}
