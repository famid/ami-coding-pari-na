<?php


namespace App\Http\Controllers\Web\Auth;


use Illuminate\Contracts\Foundation\Application;
use App\Http\Services\Auth\Web\RegisterService;
use App\Http\Requests\Web\SignUpRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RegisterController extends Controller {

    /**
     * @var RegisterService
     */
    protected $registerService;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService) {
        $this->registerService = $registerService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index() {
        return view('ami_coding_pari_na.auth.sign_up');
    }

    /**
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function signUp(SignUpRequest $request): RedirectResponse {
        return $this->webResponse($this->registerService->signUp($request), 'web.auth.sign_in.index');
    }
}
