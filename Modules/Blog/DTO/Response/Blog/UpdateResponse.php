<?php

namespace Modules\Blog\DTO\Response\Blog;

use App\DTO\DTO;

class UpdateResponse extends DTO
{
    public ?string $id;
    public ?string $user_id;
    public ?string $blog_category_id;
    public ?string $title;
    public ?string $slug;
    public ?string $content;
    public ?bool $is_active;
    public ?string $created_at;
    public ?string $updated_at;
}
