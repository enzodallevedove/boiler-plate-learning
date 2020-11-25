<?php

namespace App\Http\GraphQL\Queries\Products;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Products\GetProductWhere;

class ProductsQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Product Name',
        'sku' => 'Product Sku',
        'description' => 'Product Description',
        'price' => 'Product Price',
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('product'));
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
            'sku' => [
                'name' => 'sku',
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

        if (isset($args['sku'])) {
            $where->put('sku', $args['sku']);
        }

        return $this->dispatch(new GetProductWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
