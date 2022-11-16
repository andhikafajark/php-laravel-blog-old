<?php

namespace Modules\Auth\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helpers\LogHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Auth\DTO\Request\LoginRequest;
use Modules\Auth\Http\Requests\Login\LoginRequest as LoginHttpRequest;
use Modules\Auth\Services\AuthService;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Laravel\Module;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private Module $_module;
    private string $_route = 'auth.login';
    private string $_routeView = 'login';
    private string $_title = 'Login';

    /**
     * Create a new controller instance.
     */
    public function __construct(private AuthService $authService)
    {
        $moduleName = explode("\\", static::class)[1];

        $this->_module = ModuleFacade::find($moduleName);
    }


    /**
     * Display login page.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $data = [
            'route' => $this->_route,
            'title' => $this->_title
        ];

        return view($this->_module->getLowerName() . '::' . $this->_routeView . '.' . __FUNCTION__, $data);
    }

    /**
     * Authenticate user login.
     *
     * @param LoginHttpRequest $request
     * @return JsonResponse
     * @throws BadRequestException|Exception
     */
    public function login(LoginHttpRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $loginRequest = new LoginRequest($request->all());

            LogHelper::auditTrail($request, $this->_title);

            $this->authService->login($loginRequest);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => [
                    'route' => route('/')
                ]
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            LogHelper::exception($e, __METHOD__);

            throw $e;
        }
    }
}
