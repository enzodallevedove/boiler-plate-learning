<?php

namespace App\Http\GraphQL\Types;

use App\Models\SaleItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SaleItemType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'SaleItem',
        'description' => 'A type',
        'model' => SaleItem::class
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
            'sale_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Status of the Sale'
            ],
            'product_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'SaleItem Product Id'
            ],
            'qty' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Qty of product'
            ]
        ];
    }
}
