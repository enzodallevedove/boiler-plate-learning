<?php

namespace App\Http\GraphQL\Types;

use App\Models\Sale;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SaleType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Sales',
        'description' => 'A type',
        'model' => Sale::class
    ];

    /**
     * define field of type
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Sale'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Status of the Sale'
            ],
            'grand_total' => [
                'type' => Type::float(),
                'description' => 'Sale grand total value'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'User data'
            ],
            'sale_items' => [
                'type' => Type::listOf(GraphQL::type('saleItem')),
                'description' => 'Products and qty from items'
            ]
        ];
    }

    protected function resolveSaleItemsField($root, array $args)
    {
        return $root->saleItems;
    }
}
