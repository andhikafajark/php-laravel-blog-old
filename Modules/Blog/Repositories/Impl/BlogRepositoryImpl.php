<?php

namespace Modules\Blog\Repositories\Impl;

use App\Domain\FilterDomain;
use App\Repositories\Impl\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Blog\Domain\BlogDomain;
use Modules\Blog\Models\Blog;
use Modules\Blog\Repositories\BlogRepository;

class BlogRepositoryImpl extends Repository implements BlogRepository
{
    protected array $allColumnOrder = ['title', 'slug', 'content', 'is_active', 'created_at', 'updated_at'];
    protected array $allColumnSearch = ['title', 'slug', 'content', 'created_at', 'updated_at'];
    protected array $allRelation = [
        'self' => [
            'conditions' => [
                'where' => ['title', 'slug', 'content', 'is_active']
            ]
        ]
    ];

    public function __construct(Blog $blog)
    {
        parent::__construct($blog);
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
     * @param BlogDomain $blogDomain
     * @return BlogDomain
     */
    public function create(BlogDomain $blogDomain): BlogDomain
    {
        $data = $this->model->create($blogDomain->toArray());

        $blogDomain->refresh($data->toArray());

        return $blogDomain;
    }

    /**
     * Get specific resource from DB.
     *
     * @param BlogDomain $blogDomain
     * @param FilterDomain|null $filterDomain
     * @return BlogDomain
     * @throws ModelNotFoundException
     */
    public function getOne(BlogDomain $blogDomain, ?FilterDomain $filterDomain = null): BlogDomain
    {
        $builder = $this->model;

        if ($filterDomain?->relations) {
            $builder = $this->__filterWith($builder, $filterDomain->relations);
        }

        $data = $builder->findOrFail($blogDomain->id);

        $blogDomain->refresh($data->toArray());

        return $blogDomain;
    }

    /**
     * Update specific resource from DB.
     *
     * @param BlogDomain $blogDomain
     * @return BlogDomain
     * @throws ModelNotFoundException
     */
    public function update(BlogDomain $blogDomain): BlogDomain
    {
        $this->model
            ->findOrFail($blogDomain->id)
            ->update($blogDomain->toArray());

        $data = $this->model->findOrFail($blogDomain->id);

        $blogDomain->refresh($data->toArray());

        return $blogDomain;
    }

    /**
     * Delete specific resource from DB.
     *
     * @param BlogDomain $blogDomain
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(BlogDomain $blogDomain): bool
    {
        return $this->model->findOrFail($blogDomain->id)->delete();
    }
}
