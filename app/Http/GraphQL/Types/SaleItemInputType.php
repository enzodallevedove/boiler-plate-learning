<?php

namespace App\Http\GraphQL\Types;

use App\Models\SaleItemInput;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class SaleItemInputType extends InputType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'SaleItemInput',
        'description' => 'A type',
    ];

    /**
     * define field of type
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'product_id' => [
                'name' => 'product_id',
                'type' => Type::int(),
                'description' => 'SaleItemInput Product Id'
            ],
            'qty' => [
                'name' => 'qty',
                'type' => Type::int(),
                'description' => 'Qty of product'
            ]
        ];
    }
}
