<?php

namespace App\Http\GraphQL\Mutations\Products;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Products\UpdateProduct;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdateProductMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdateProduct'
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
            'id' =>['required'],
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
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'sku' => [
                'name' => 'sku',
                'type' => Type::string()
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'price' => [
                'price' => 'price',
                'type' => Type::float()
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
        $productId = $args['id'];
        unset($args['id']);

        return $this->dispatch(new UpdateProduct($productId, $args));
    }
}
