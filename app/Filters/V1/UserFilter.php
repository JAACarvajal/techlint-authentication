<?php

namespace App\Filters\V1;
use Illuminate\Database\Eloquent\Builder;

/**
 * Summary of IpAddressFilter
 */
class UserFilter extends Filter
{
    /**
     * List of sortable fields
     * @var array
     */
    protected $sortables = [
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];

    /**
     * Filter by created_at date
     * @param string $value
     */
    public function createdAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    /**
     * Include related models
     * @param string $value
     */
    public function include($value): Builder
    {
        return $this->builder->with($value);
    }

    /**
     * Filter by updated_at date
     * @param string $value
     */
    public function updatedAt($value): Builder
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }
}
