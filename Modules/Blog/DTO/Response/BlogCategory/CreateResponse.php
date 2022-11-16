<?php

namespace Modules\Blog\DTO\Response\BlogCategory;

use App\DTO\DTO;

class CreateResponse extends DTO
{
    public ?string $id;
    public ?string $title;
    public ?string $slug;
    public ?string $created_at;
    public ?string $updated_at;
}
