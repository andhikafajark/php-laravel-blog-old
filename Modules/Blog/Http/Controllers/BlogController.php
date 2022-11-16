<?php

namespace Modules\Blog\Http\Controllers;

use App\DTO\Request\DeleteRequest;
use App\DTO\Request\IndexRequest;
use App\Helpers\LogHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Blog\DTO\Request\Blog\CreateRequest;
use Modules\Blog\DTO\Request\Blog\UpdateRequest;
use Modules\Blog\Http\Requests\Blog\CreateRequest as CreateHttpRequest;
use Modules\Blog\Http\Requests\Blog\UpdateRequest as UpdateHttpRequest;
use Modules\Blog\Models\Blog;
use Modules\Blog\Services\BlogCategoryService;
use Modules\Blog\Services\BlogService;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use Nwidart\Modules\Laravel\Module;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    private Module $_module;
    private string $_route = 'blog';
    private string $_title = 'Blog';

    /**
     * Create a new controller instance.
     */
    public function __construct(
        private BlogService         $blogService,
        private BlogCategoryService $blogCategoryService
    )
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
                'Blog' => null
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
            $data = Blog::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ?
                        '<span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded">Active</span>' :
                        '<span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded">Inactive</span>';
                })
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
                ->make(true);
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
//            $data = $this->blogService->getAll($indexRequest);
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
                'Blog' => $this->_route . '.index',
                'Create' => null
            ],
            'blogCategories' => json_decode(json_encode($this->blogCategoryService->getAll(new IndexRequest())))
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

            $request->merge([
                'user_id' => auth()->id() ?? 'e976eba4-6853-4405-9549-a503ab645981'
            ]);

            LogHelper::auditTrail($request, "Create $this->_title");

            $createRequest = new CreateRequest($request->all());

            $data = $this->blogService->create($createRequest);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Create Success',
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
     * @param Blog $blog
     * @return Application|Factory|View
     */
    public function edit(Blog $blog): View|Factory|Application
    {
        $data = [
            'route' => $this->_route,
            'title' => 'Edit ' . $this->_title,
            'breadcrumbs' => (object)[
                'Dashboard' => '/',
                'Blog Category' => $this->_route . '.index',
                'Edit' => null
            ],
            'blog' => $blog,
            'blogCategories' => json_decode(json_encode($this->blogCategoryService->getAll(new IndexRequest())))
        ];

        return view($this->_module->getLowerName() . '::' . $this->_route . '.' . __FUNCTION__, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHttpRequest $request
     * @param Blog $blog
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateHttpRequest $request, Blog $blog): JsonResponse
    {
        try {
            DB::beginTransaction();

            LogHelper::auditTrail($request, "Update $this->_title");

            $data = $request
                ->merge([
                    'id' => $blog->id
                ])
                ->all();

            $updateRequest = new UpdateRequest($data);

            $data = $this->blogService->update($updateRequest);

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
     * @param Blog $blog
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Request $request, Blog $blog): JsonResponse
    {
        try {
            DB::beginTransaction();

            LogHelper::auditTrail($request, "Delete $this->_title");

            $deleteRequest = new DeleteRequest(['id' => $blog->id]);

            $this->blogService->delete($deleteRequest);

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
