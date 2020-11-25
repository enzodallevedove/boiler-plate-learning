<?php

namespace App\Http\GraphQL\Queries\Suppliers;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Suppliers\GetSuppliersWhere;

class SuppliersQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'cnpj' => 'company cnpj number',
        'company_name' => 'company name',
        'trading_name' => 'trading name from company',
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('supplier'));
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
            'cnpj' => [
                'name' => 'cnpj',
                'type' => Type::string()
            ],
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

        return $this->dispatch(new GetSupplierWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
