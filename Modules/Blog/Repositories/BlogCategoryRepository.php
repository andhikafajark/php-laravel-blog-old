<?php

namespace Modules\Blog\Repositories;

use App\Domain\FilterDomain;
use Modules\Blog\Domain\BlogCategoryDomain;

interface BlogCategoryRepository
{
    public function getAll(FilterDomain $filterDomain): array;

    public function create(BlogCategoryDomain $blogCategoryDomain): BlogCategoryDomain;

    public function getOne(BlogCategoryDomain $blogCategoryDomain, ?FilterDomain $filterDomain = null): BlogCategoryDomain;

    public function update(BlogCategoryDomain $blogCategoryDomain): BlogCategoryDomain;

    public function delete(BlogCategoryDomain $blogCategoryDomain): bool;
}
