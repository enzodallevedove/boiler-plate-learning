<?php

namespace App\Http\GraphQL\Types;

use App\Models\Supplier;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SupplierType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Suppliers',
        'description' => 'A type',
        'model' => Supplier::class
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
                'description' => 'The id of the supplier'
            ],
            'cnpj' => [
                'type' => Type::string(),
                'description' => 'The cnpj of the company'
            ],
            'company_name' => [
                'type' => Type::string(),
                'description' => 'Name of the company'
            ],
            'trading_name' => [
                'type' => Type::string(),
                'description' => 'Trading name of the company'
            ],
        ];
    }
}
