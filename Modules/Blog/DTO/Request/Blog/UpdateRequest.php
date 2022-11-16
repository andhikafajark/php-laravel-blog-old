<?php

namespace Modules\Blog\DTO\Request\Blog;

use App\DTO\DTO;
use Illuminate\Http\UploadedFile;
use ReflectionClass;

class UpdateRequest extends DTO
{
    public string $id;
    public ?string $user_id;
    public ?string $blog_category_id;
    public ?string $title;
    public ?string $slug;
    public ?string $content;
    public ?bool $is_active;

    public function __construct(array $data)
    {
        $reflection = new ReflectionClass(static::class);

        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();

            if (in_array($propertyName, array_keys($data))) {
                if (!$property->getType()->isBuiltin()) {
                    $class = $property->getType()->getName();

                    if ($class === UploadedFile::class) {
                        $this->$propertyName = $data[$propertyName];
                    } else {
                        $this->$propertyName = new $class((array)$data[$propertyName]);
                    }
                } else {
                    $typeData = $property->getType()->getName();

                    if ($typeData === 'object') {
                        $this->$propertyName = (object)json_decode(json_encode($data[$propertyName]));
                    } else if ($typeData === 'array') {
                        $this->$propertyName = (array)$data[$propertyName];
                    } else {
                        $this->$propertyName = $data[$propertyName];
                    }
                }

                if ($propertyName === 'title') {
                    $this->slug = str($data[$propertyName])->slug();
                }
            }
        }
    }
}
