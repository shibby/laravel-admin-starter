<?php

namespace App\Http\Controllers\Api;

use App\Service\CityService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class CityController extends \Illuminate\Routing\Controller
{
    use ValidatesRequests;

    /**
     * @var CityService
     */
    private $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function getDistrictsAction(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required|numeric',
        ]);

        $districts = $this->cityService->getDistricts($request->query->get('city_id'));

        return response()->json([
            'data' => $districts->toArray(),
        ]);
    }
}
