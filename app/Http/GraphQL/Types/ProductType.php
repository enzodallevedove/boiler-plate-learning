<?php

namespace App\Http\GraphQL\Types;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Products',
        'description' => 'A type',
        'model' => Product::class
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
                'description' => 'The id of the product'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Product name'
            ],
            'sku' => [
                'type' => Type::string(),
                'description' => 'Sku of the product'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Product description'
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'Price of the product'
            ]
        ];
    }
}
