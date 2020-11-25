<?php

namespace App\Http\GraphQL\Mutations\Sales;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Sales\UpdateSale;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdateSaleMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdateSale'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('sale');
    }

    /**
     * @param array $args
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'id' => ['required'],
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
            'status' => [
                'name' => 'status',
                'type' => Type::string()
            ],
            'grand_total' => [
                'name' => 'grand_total',
                'type' => Type::nonNull(Type::float())
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::int())
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
        $saleId = $args['id'];
        unset($args['id']);

        return $this->dispatch(new UpdateSale($saleId, $args));
    }
}
