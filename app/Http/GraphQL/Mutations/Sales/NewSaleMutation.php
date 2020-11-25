<?php

namespace App\Http\GraphQL\Mutations\Sales;

use App\Services\Commands\SaleItems\CreateSaleItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Sales\CreateSale;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class NewSaleMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewSale'
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
            'user_id' => ['required'],
            'grand_total' => ['required'],
            'sale_items' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
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
            'sale_items' => [
                'name' => 'sale_items',
                'type' => Type::listOf(GraphQL::type('saleItemInput')),
            ]
        ];
    }


    /**
     * @param mixed $root
     * @param array $args
     * @return null|Object
     */
    public function resolve($root, array $args):? Object
    {
        $saleItems = $args['sale_items'];
        unset($args['sale_items']);
        $sale = $this->dispatch(new CreateSale($args));
        $sale['id'];
        $saleItemsReturn = [];
        foreach($saleItems as $saleItem){
            $saleItem['sale_id'] = $sale['id'];
            $saleItemsReturn[] = $this->dispatch(new CreateSaleItem($saleItem));
        }
        $sale['sale_items'] = $saleItemsReturn;
        return $sale;
    }
}
