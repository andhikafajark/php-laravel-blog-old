<?php

namespace Modules\Blog\Domain;

use App\Domain\Domain;

class BlogCategoryDomain extends Domain
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $slug = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    /**
     * Convert this object attribute to array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = clone $this;

        if (!isset($data->id)) unset($data->id);

        return (array)$data;
    }
}
