<?php

namespace App\Http\GraphQL\Mutations\Suppliers;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Suppliers\UpdateSupplier;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdateSupplierMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdateSupplier'
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
            'id' =>['required'],
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
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'cnpj' => [
                'name' => 'cnpj',
                'type' => Type::string()
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
        $supplierId = $args['id'];
        unset($args['id']);

        return $this->dispatch(new UpdateSupplier($supplierId, $args));
    }
}
