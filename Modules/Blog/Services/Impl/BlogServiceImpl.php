<?php

namespace Modules\Blog\Services\Impl;

use App\Domain\FilterDomain;
use App\DTO\Request\DeleteRequest;
use App\DTO\Request\IndexRequest;
use App\DTO\Request\ShowRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Blog\Domain\BlogDomain;
use Modules\Blog\DTO\Request\Blog\CreateRequest;
use Modules\Blog\DTO\Request\Blog\UpdateRequest;
use Modules\Blog\DTO\Response\Blog\CreateResponse;
use Modules\Blog\DTO\Response\Blog\ShowResponse;
use Modules\Blog\DTO\Response\Blog\UpdateResponse;
use Modules\Blog\Repositories\BlogRepository;
use Modules\Blog\Services\BlogService;

class BlogServiceImpl implements BlogService
{
    public function __construct(private BlogRepository $blogRepository)
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

        return $this->blogRepository->getAll($filterDomain);
    }

    /**
     * Create a resource.
     *
     * @param CreateRequest $createRequest
     * @return CreateResponse
     */
    public function create(CreateRequest $createRequest): CreateResponse
    {
        $blogDomain = new BlogDomain($createRequest->toArray());

        $blogDomain = $this->blogRepository->create($blogDomain);

        return new CreateResponse($blogDomain->toArray());
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
        $blogDomain = new BlogDomain($showRequest->toArray());
        $filterDomain = new FilterDomain($showRequest->toArray());

        $blogDomain = $this->blogRepository->getOne($blogDomain, $filterDomain);

        return new ShowResponse($blogDomain->toArray());
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
        $blogDomain = new BlogDomain($updateRequest->toArray());

        $blogDomain = $this->blogRepository->update($blogDomain);

        return new UpdateResponse($blogDomain->toArray());
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
        $blogDomain = new BlogDomain($deleteRequest->toArray());

        return $this->blogRepository->delete($blogDomain);
    }
}
