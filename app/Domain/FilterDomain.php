<?php

namespace App\Domain;

class FilterDomain extends Domain
{
    public bool $datatable = false;
    public ?int $limit = null;
    public ?int $offset = null;
    public ?string $orderColumn = null;
    public ?string $orderDirection = null;
    public ?string $search = '';
    public ?string $relations = null;
    public ?string $conditions = null;

    /**
     * Convert this object attribute to array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = clone $this;

        if (!isset($data->limit)) unset($data->limit);
        if (!isset($data->offset)) unset($data->offset);
        if (!isset($data->orderColumn)) unset($data->orderColumn);
        if (!isset($data->orderDirection)) unset($data->orderDirection);
        if (!isset($data->relations)) unset($data->relations);
        if (!isset($data->conditions)) unset($data->conditions);

        return (array)$data;
    }
}
