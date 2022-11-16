<?php

namespace Modules\Blog\Services;

use App\DTO\Request\DeleteRequest;
use App\DTO\Request\IndexRequest;
use App\DTO\Request\ShowRequest;
use Modules\Blog\DTO\Request\BlogCategory\CreateRequest;
use Modules\Blog\DTO\Request\BlogCategory\UpdateRequest;
use Modules\Blog\DTO\Response\BlogCategory\CreateResponse;
use Modules\Blog\DTO\Response\BlogCategory\ShowResponse;
use Modules\Blog\DTO\Response\BlogCategory\UpdateResponse;

interface BlogCategoryService
{
    public function getAll(IndexRequest $indexRequest): array;

    public function create(CreateRequest $createRequest): CreateResponse;

    public function getOne(ShowRequest $showRequest): ShowResponse;

    public function update(UpdateRequest $updateRequest): UpdateResponse;

    public function delete(DeleteRequest $deleteRequest): bool;
}
