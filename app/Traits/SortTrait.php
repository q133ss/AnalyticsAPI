<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait SortTrait
{
    public function scopeWithSortDefault($query, Request $request)
    {
        if (empty($request->query('sort'))) {
            $query->orderBy('created_at', 'DESC');
        }
    }

    public function scopeWithSort($query, Request $request)
    {
        return $query
            ->when($request->query('sort'), function (Builder $query, $sort) {
                $sortDirection = str_starts_with($sort, '-') ? 'desc' : 'asc';
                $sortColumn = ltrim($sort, '-');
                return $query->orderBy($sortColumn, $sortDirection);
            });
    }
}
