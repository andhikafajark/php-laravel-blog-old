<?php

namespace Modules\Blog\Http\Controllers;

use App\DTO\Request\DeleteRequest;
use App\Helpers\LogHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Blog\DTO\Request\BlogCategory\CreateRequest;
use Modules\Blog\DTO\Request\BlogCategory\UpdateRequest;
use Modules\Blog\Http\Requests\BlogCategory\CreateRequest as CreateHttpRequest;
use Modules\Blog\Http\Requests\BlogCategory\UpdateRequest as UpdateHttpRequest;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Services\BlogCategoryService;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Laravel\Module;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

//use Yajra\DataTables\DataTables;

class BlogCategoryController extends Controller
{
    private Module $_module;
    private string $_route = 'blog-category';
    private string $_title = 'Blog Category';

    /**
     * Create a new controller instance.
     */
    public function __construct(private BlogCategoryService $blogCategoryService)
    {
        $moduleName = explode("\\", static::class)[1];

        $this->_module = ModuleFacade::find($moduleName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'route' => $this->_route,
            'title' => $this->_title,
            'breadcrumbs' => (object)[
                'Dashboard' => '/',
                'Blog Category' => null
            ]
        ];

        return view($this->_module->getLowerName() . '::' . $this->_route . '.' . __FUNCTION__, $data);
    }

    /**
     * Get data for DataTables
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables(Request $request): JsonResponse
    {
        try {
            $data = BlogCategory::query();

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return
                        '<a href="' . route($this->_route . '.edit', $data) . '" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">
                            Edit
                        </a>
                        <button type="button" data-url="' . route($this->_route . '.destroy', $data) . '" class="delete text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Delete
                        </button>';
                })
                ->rawColumns(['is_active', 'action'])
                ->toJson();
        } catch (Exception $e) {
            LogHelper::exception($e, __METHOD__);

            throw $e;
        }
    }

//    /**
//     * Display a listing of the resource.
//     *
//     * @param IndexHttpRequest $request
//     * @return JsonResponse
//     * @throws Exception
//     */
//    public function index(IndexHttpRequest $request): JsonResponse
//    {
//        try {
//            $indexRequest = new IndexRequest($request->all());
//
//            $data = $this->blogCategoryService->getAll($indexRequest);
//
//            return response()->json([
//                'success' => true,
//                'message' => 'Get All Data Success',
//                'data' => $data
//            ], Response::HTTP_OK);
//        } catch (Exception $e) {
//            LogHelper::exception($e, __METHOD__);
//
//            throw $e;
//        }
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $data = [
            'route' => $this->_route,
            'title' => 'Create ' . $this->_title,
            'breadcrumbs' => (object)[
                'Dashboard' => '/',
                'Blog Category' => $this->_route . '.index',
                'Create' => null
            ]
        ];

        return view($this->_module->getLowerName() . '::' . $this->_route . '.' . __FUNCTION__, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateHttpRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CreateHttpRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            LogHelper::auditTrail($request, "Create $this->_title");

            $createRequest = new CreateRequest($request->all());

            $data = $this->blogCategoryService->create($createRequest);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Create Data Success',
                'data' => $data->toArray()
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();

            LogHelper::exception($e, __METHOD__);

            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return Application|Factory|View
     */
    public function edit(BlogCategory $blogCategory): View|Factory|Application
    {
        $data = [
            'route' => $this->_route,
            'title' => 'Edit ' . $this->_title,
            'breadcrumbs' => (object)[
                'Dashboard' => '/',
                'Blog Category' => $this->_route . '.index',
                'Edit' => null
            ],
            'blogCategory' => $blogCategory
        ];

        return view($this->_module->getLowerName() . '::' . $this->_route . '.' . __FUNCTION__, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHttpRequest $request
     * @param BlogCategory $blogCategory
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateHttpRequest $request, BlogCategory $blogCategory): JsonResponse
    {
        try {
            DB::beginTransaction();

            LogHelper::auditTrail($request, "Update $this->_title");

            $data = $request
                ->merge([
                    'id' => $blogCategory->id
                ])
                ->all();

            $updateRequest = new UpdateRequest($data);

            $data = $this->blogCategoryService->update($updateRequest);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Update Data Success',
                'data' => $data->toArray()
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            LogHelper::exception($e, __METHOD__);

            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param BlogCategory $blogCategory
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Request $request, BlogCategory $blogCategory): JsonResponse
    {
        try {
            DB::beginTransaction();

            LogHelper::auditTrail($request, "Delete $this->_title");

            $deleteRequest = new DeleteRequest(['id' => $blogCategory->id]);

            $this->blogCategoryService->delete($deleteRequest);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Delete Data Success',
                'data' => null
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();

            LogHelper::exception($e, __METHOD__);

            throw $e;
        }
    }
}
