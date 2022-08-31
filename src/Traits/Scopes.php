<?php

namespace Ferasalhallak\SmartLaravel\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

trait Scopes
{

    public function scopeDynamicFilter(Builder $query, $operator = [])
    {
        if (!request()->filters) return $query;
        $filter = request()->filters;
        return $query->where(function ($query) use ($filter, $operator) {
            foreach ($filter as $col => $value) {
                switch ($operator[$col] ?? '') {
                    case 'LIKE':
                        $query->where($col, 'LIKE', '%' . $filter[$col] . '%');
                        break;
                    default:
                        $query->where($col, $filter[$col]);
                        break;
                }
            }
        });
    }

    public function scopeFilterColumn(Builder $query, string $columnName, $operator = '=')
    {
        if (!request()->{$columnName}) return $query;

        switch ($operator) {
            case '=':
                return $query->where($columnName, $operator, request()->{$columnName});
                break;
            case 'LIKE':
                return $query->where($columnName, $operator, '%' . request()->{$columnName} . '%');
                break;
            default:
                return $query->where($columnName, $operator, request()->{$columnName});
                break;
        }
    }


    public function scopeOrderByCrud(Builder $query,$defaultColumn = 'created_at')
    {
        return $query->orderBy(request()->sort_column ?? $defaultColumn, request()->sort_direction ?? 'desc');
    }
}
