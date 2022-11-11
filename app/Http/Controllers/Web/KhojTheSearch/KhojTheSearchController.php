<?php

namespace App\Http\Controllers\Web\KhojTheSearch;

use App\Http\Requests\Web\KhojTheSearchRequest;
use App\Http\Services\KhojTheSearch\KhojTheSearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
     * @return Application|Factory|View
     */
    public function index() {
        return view('ami_coding_pari_na.khoj_the_search.home');
    }

    /**
     * @param KhojTheSearchRequest $request
     * @return JsonResponse
     */
    public function store(KhojTheSearchRequest $request) {
        return response()->json($this->khojTheSearchService->storeUserInputs($request));
    }
}
