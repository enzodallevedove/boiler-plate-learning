<?php

namespace App\Http\GraphQL\Queries\Sales;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Sales\GetSaleWhere;

class SalesQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'status' => 'sale status',
        'grand_total' => 'sale grand total value',
        'user_id' => 'user who made the buy',
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('sale'));
    }

    /**
     * arguments to filter query
     *
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int()
            ]
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Collection
     */
    public function resolve(
        $root,
        array $args,
        $context,
        ResolveInfo $resolveInfo,
        Closure $getSelectFields
    ): Collection {
        $with = collect([]);
        $where = collect([]);

        foreach ($context->getRelations() as $roleName => $field) {
            if ($roleName === 'role') {
                $with->push($roleName);
            }
        }

        if (isset($args['id'])) {
            $where->put('id', $args['id']);
        }

        return $this->dispatch(new GetSaleWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
