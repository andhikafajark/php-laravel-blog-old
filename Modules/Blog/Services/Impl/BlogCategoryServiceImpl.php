<?php

namespace Modules\Blog\Services\Impl;

use App\Domain\FilterDomain;
use App\DTO\Request\DeleteRequest;
use App\DTO\Request\IndexRequest;
use App\DTO\Request\ShowRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Blog\Domain\BlogCategoryDomain;
use Modules\Blog\DTO\Request\BlogCategory\CreateRequest;
use Modules\Blog\DTO\Request\BlogCategory\UpdateRequest;
use Modules\Blog\DTO\Response\BlogCategory\CreateResponse;
use Modules\Blog\DTO\Response\BlogCategory\ShowResponse;
use Modules\Blog\DTO\Response\BlogCategory\UpdateResponse;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Services\BlogCategoryService;

class BlogCategoryServiceImpl implements BlogCategoryService
{
    public function __construct(private BlogCategoryRepository $blogCategoryRepository)
    {
    }

    /**
     * Get all the resource.
     *
     * @param IndexRequest $indexRequest
     * @return array
     */
    public function getAll(IndexRequest $indexRequest): array
    {
        $filterDomain = new FilterDomain($indexRequest->toArray());

        return $this->blogCategoryRepository->getAll($filterDomain);
    }

    /**
     * Create a resource.
     *
     * @param CreateRequest $createRequest
     * @return CreateResponse
     */
    public function create(CreateRequest $createRequest): CreateResponse
    {
        $blogCategoryDomain = new BlogCategoryDomain($createRequest->toArray());

        $blogCategoryDomain = $this->blogCategoryRepository->create($blogCategoryDomain);

        return new CreateResponse($blogCategoryDomain->toArray());
    }

    /**
     * Get specific resource.
     *
     * @param ShowRequest $showRequest
     * @return ShowResponse
     * @throws ModelNotFoundException
     */
    public function getOne(ShowRequest $showRequest): ShowResponse
    {
        $blogCategoryDomain = new BlogCategoryDomain($showRequest->toArray());
        $filterDomain = new FilterDomain($showRequest->toArray());

        $blogCategoryDomain = $this->blogCategoryRepository->getOne($blogCategoryDomain, $filterDomain);

        return new ShowResponse($blogCategoryDomain->toArray());
    }


    /**
     * Update specific resource.
     *
     * @param UpdateRequest $updateRequest
     * @return UpdateResponse
     * @throws ModelNotFoundException
     */
    public function update(UpdateRequest $updateRequest): UpdateResponse
    {
        $blogCategoryDomain = new BlogCategoryDomain($updateRequest->toArray());

        $blogCategoryDomain = $this->blogCategoryRepository->update($blogCategoryDomain);

        return new UpdateResponse($blogCategoryDomain->toArray());
    }

    /**
     * Delete specific resource.
     *
     * @param DeleteRequest $deleteRequest
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(DeleteRequest $deleteRequest): bool
    {
        $blogCategoryDomain = new BlogCategoryDomain($deleteRequest->toArray());

        return $this->blogCategoryRepository->delete($blogCategoryDomain);
    }
}
