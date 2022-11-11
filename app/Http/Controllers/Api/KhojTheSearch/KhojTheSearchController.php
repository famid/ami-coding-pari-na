<?php

namespace App\Http\Controllers\Api\KhojTheSearch;

use App\Http\Requests\Api\GetAllInputValuesRequest;
use App\Http\Services\KhojTheSearch\KhojTheSearchService;
use Illuminate\Http\JsonResponse;

class KhojTheSearchController {

    /**
     * @var KhojTheSearchService
     */
    private KhojTheSearchService $khojTheSearchService;

    /**
     * @param KhojTheSearchService $khojTheSearchService
     */
    public function __construct(KhojTheSearchService $khojTheSearchService) {
        $this->khojTheSearchService = $khojTheSearchService;
    }

    /**
     * @param GetAllInputValuesRequest $request
     * @return JsonResponse
     */
    public function getAllInputValues(GetAllInputValuesRequest $request): JsonResponse {
        return response()->json($this->khojTheSearchService->userInputList($request));
    }
}
