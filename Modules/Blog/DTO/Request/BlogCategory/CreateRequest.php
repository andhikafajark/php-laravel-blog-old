<?php

namespace Modules\Blog\DTO\Request\BlogCategory;

use App\DTO\DTO;
use Illuminate\Http\UploadedFile;
use ReflectionClass;

class CreateRequest extends DTO
{
    public string $title;
    public string $slug;

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
