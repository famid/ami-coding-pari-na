<?php

namespace App\Http\Repositories;

use App\Models\KhojTheSearch;

class KhojTheSearchRepository extends BaseRepository {

    protected $model;
    /**
     * KhojTheSearchSearchRepository constructor.
     * @param KhojTheSearch $khojTheSearch
     */
    public function __construct(KhojTheSearch $khojTheSearch) {
        parent::__construct($khojTheSearch);
    }

    /**
     * @param int $userId
     * @param $from
     * @param $to
     * @return mixed
     */
    public function userAllInputs(int $userId, $from, $to) {
        return $this->model::select('created_at as timestamp', 'input_values')
            ->where(['user_id' => $userId])
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }
}
