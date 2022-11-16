<?php

namespace Modules\Blog\Repositories;

use App\Domain\FilterDomain;
use Modules\Blog\Domain\BlogDomain;

interface BlogRepository
{
    public function getAll(FilterDomain $filterDomain): array;

    public function create(BlogDomain $blogDomain): BlogDomain;

    public function getOne(BlogDomain $blogDomain, ?FilterDomain $filterDomain = null): BlogDomain;

    public function update(BlogDomain $blogDomain): BlogDomain;

    public function delete(BlogDomain $blogDomain): bool;
}
