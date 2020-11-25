<?php

namespace Tests\Unit\Handlers\Products;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Commands\Products\GetProductWhere as CommandGetProductWhere;
use App\Services\Handlers\Products\GetProductWhere as HandlerGetProductWhere;
use Tests\TestCase;
use Illuminate\Container\Container as Application;

class GetProductWhereTest extends TestCase
{
    public function test_can_handle()
    {
        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];
        $model = Product::create($data);
        $data['id'] = $model->id;

        $command = new CommandGetProductWhere([
            'id' => $data['id'],
            'name' => $data['name'],
            'sku' => $data['sku'],
            'description' => $data['description'],
            'price' => $data['price']
        ], ['*'], []);
        $repository = new ProductRepository(Application::getInstance());
        $handler = new HandlerGetProductWhere($repository);
        $handle = $handler->handle($command);
        if($handle->count()==1){
            $this->assertTrue(isset($handle->first()->id));
            $this->assertEquals($data['name'],$handle->first()->name);
            $this->assertEquals($data['sku'],$handle->first()->sku);
            $this->assertEquals($data['description'],$handle->first()->description);
            $this->assertEquals($data['price'],$handle->first()->price);
        }
    }
}
