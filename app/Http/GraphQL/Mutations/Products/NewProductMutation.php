<?php

namespace App\Http\GraphQL\Mutations\Products;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Products\CreateProduct;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class NewProductMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewProduct'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('product');
    }

    /**
     * @param array $args
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'name' => ['required'],
            'sku' => ['required'],
            'price' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'sku' => [
                'name' => 'sku',
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::nonNull(Type::float())
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
        return $this->dispatch(new CreateProduct($args));
    }
}
