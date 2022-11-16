<?php

namespace Modules\Blog\Repositories\Impl;

use App\Domain\FilterDomain;
use App\Repositories\Impl\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Blog\Domain\BlogCategoryDomain;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Repositories\BlogCategoryRepository;

class BlogCategoryRepositoryImpl extends Repository implements BlogCategoryRepository
{
    protected array $allColumnOrder = ['title', 'slug', 'created_at', 'updated_at'];
    protected array $allColumnSearch = ['title', 'slug', 'created_at', 'updated_at'];
    protected array $allRelation = [
        'self' => [
            'conditions' => [
                'where' => ['title', 'slug']
            ]
        ]
    ];

    public function __construct(BlogCategory $blogCategory)
    {
        parent::__construct($blogCategory);
    }

    /**
     * Get all the resource from DB.
     *
     * @param FilterDomain $filterDomain
     * @return array
     */
    public function getAll(FilterDomain $filterDomain): array
    {
        return match (true) {
            $filterDomain->datatable => $this->__getDatatable($filterDomain),
            default => $this->__getAll($filterDomain)
        };
    }

    /**
     * Create a resource from DB.
     *
     * @param BlogCategoryDomain $blogCategoryDomain
     * @return BlogCategoryDomain
     */
    public function create(BlogCategoryDomain $blogCategoryDomain): BlogCategoryDomain
    {
        $data = $this->model->create($blogCategoryDomain->toArray());

        $blogCategoryDomain->refresh($data->toArray());

        return $blogCategoryDomain;
    }

    /**
     * Get specific resource from DB.
     *
     * @param BlogCategoryDomain $blogCategoryDomain
     * @param FilterDomain|null $filterDomain
     * @return BlogCategoryDomain
     * @throws ModelNotFoundException
     */
    public function getOne(BlogCategoryDomain $blogCategoryDomain, ?FilterDomain $filterDomain = null): BlogCategoryDomain
    {
        $builder = $this->model;

        if ($filterDomain?->relations) {
            $builder = $this->__filterWith($builder, $filterDomain->relations);
        }

        $data = $builder->findOrFail($blogCategoryDomain->id);

        $blogCategoryDomain->refresh($data->toArray());

        return $blogCategoryDomain;
    }

    /**
     * Update specific resource from DB.
     *
     * @param BlogCategoryDomain $blogCategoryDomain
     * @return BlogCategoryDomain
     * @throws ModelNotFoundException
     */
    public function update(BlogCategoryDomain $blogCategoryDomain): BlogCategoryDomain
    {
        $this->model
            ->findOrFail($blogCategoryDomain->id)
            ->update($blogCategoryDomain->toArray());

        $data = $this->model->findOrFail($blogCategoryDomain->id);

        $blogCategoryDomain->refresh($data->toArray());

        return $blogCategoryDomain;
    }

    /**
     * Delete specific resource from DB.
     *
     * @param BlogCategoryDomain $blogCategoryDomain
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(BlogCategoryDomain $blogCategoryDomain): bool
    {
        return $this->model->findOrFail($blogCategoryDomain->id)->delete();
    }
}
