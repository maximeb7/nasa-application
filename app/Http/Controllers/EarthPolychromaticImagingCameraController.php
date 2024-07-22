<?php

namespace App\Http\Controllers;

use App\UseCases\GetEpicUseCase;
use Illuminate\Http\Request;

class EarthPolychromaticImagingCameraController extends Controller
{
    protected $getEpicUseCase;

    public function __construct(GetEpicUseCase $getEpicUseCase)
    {
        $this->getEpicUseCase = $getEpicUseCase;
    }

    public function __invoke(Request $request)
    {
        $day = $request->query('day');
        $month = $request->query('month');
        $year = $request->query('year');

        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            return response()->json(['error' => 'Invalid date parameters.'], 400);
        }
        $epicDto = $this->getEpicUseCase->execute($day, $month, $year);

        if ($epicDto === "") {
            return response()->json(['error' => 'Failed to retrieve EPIC data.'], 500);
        }

        return response()->json($epicDto->toArray());
    }
}
