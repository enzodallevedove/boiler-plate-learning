<?php

namespace App\Http\GraphQL\Mutations\Suppliers;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Suppliers\CreateSupplier;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class NewSupplierMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewSupplier'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('supplier');
    }

    /**
     * @param array $args
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'cnpj' => ['required'],
            'company_name' => ['required'],
            'trading_name' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'cnpj' => [
                'name' => 'cnpj',
                'type' => Type::nonNull(Type::string())
            ],
            'company_name' => [
                'name' => 'company_name',
                'type' => Type::nonNull(Type::string())
            ],
            'trading_name' => [
                'name' => 'trading_name',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }


    /**
     * @param mixed $root
     * @param array $args
     * @return null|Object
     */
    public function resolve($root, array $args):? Object
    {
        return $this->dispatch(new CreateSupplier($args));
    }
}
