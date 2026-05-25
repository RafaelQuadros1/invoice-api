<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    protected array $operators = [
        'value' => ['gt', 'lt', 'eq', 'ne', 'gte', 'lte'],
        'type' => ['eq', 'ne', 'in'],
        'paid' => ['eq', 'ne'],
        'payment_date' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
    ];

    protected array $transformers = [
        'gt' => '>',
        'lt' => '<',
        'eq' => '=',
        'ne' => '!=',
        'gte' => '>=',
        'lte' => '<=',
        'in' => 'in',
    ];

    protected array $columnMap = [
        'value' => 'amount',
        'type' => 'type',
        'paid' => 'is_paid',
        'payment_date' => 'payment_date',
    ];

    public function filter(Builder $query, Request $request): Builder
    {
        foreach ($this->operators as $param => $allowedOps) {
            $queryParam = $request->query($param);

            if (empty($queryParam) || !is_array($queryParam)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($queryParam as $op => $value) {
                if (!in_array($op, $allowedOps, true)) {
                    continue;
                }

                $sqlOp = $this->transformers[$op];

                if ($sqlOp === 'in') {
                    $query->whereIn($column, explode(',', $value));
                } else {
                    $query->where($column, $sqlOp, $value);
                }
            }
        }

        return $query;
    }
}
