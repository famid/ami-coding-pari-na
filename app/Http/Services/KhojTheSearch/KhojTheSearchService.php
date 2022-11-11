<?php

namespace App\Http\Services\KhojTheSearch;


use App\Http\Repositories\KhojTheSearchRepository;
use App\Http\Services\Boilerplate\BaseService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class KhojTheSearchService extends BaseService {


    /**
     * @var KhojTheSearchRepository
     */
    private KhojTheSearchRepository $khojTheSearchRepository;

    /**
     * KhojTheSearchService constructor.
     * @param KhojTheSearchRepository $khojTheSearchRepository
     */
    public function __construct(KhojTheSearchRepository $khojTheSearchRepository)
    {
        $this->khojTheSearchRepository = $khojTheSearchRepository;
    }


    public function userInputList($request): array {
        try {
//            $userId = Auth::user()->id;
            $userId = 11;
            $allKhojTheSearch = $this->khojTheSearchRepository->userAllInputs(
                Auth::id(),
                $request->start_datetime,
                $request->end_datetime
            );

            return $allKhojTheSearch->isEmpty() ?
                $this->response()->error('No Input value is founded') :
                $this->apiResponse($allKhojTheSearch);
        } catch (QueryException $e) {

            return $this->response()->error();
        }
    }

    public function apiResponse($payload) {
        return [
            'status' => 'success',
            'user_id' => Auth::id(),
            'payload' => $payload

        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function storeUserInputs($request): array {
        try {
            $createResponse = $this->khojTheSearchRepository->create(
                $this->preparedUserInputsData($request)
            );

            return !$createResponse ?
                $this->response()->error() :
                $this->response($createResponse)->success("Input values is saved successfully");
        } catch (QueryException $e) {
            return $this->response()->error($e->getMessage());
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function preparedUserInputsData($request): array {
        return [
            'input_values' => $request->input_values,
            'user_id' => Auth::id()
        ];
    }
}
