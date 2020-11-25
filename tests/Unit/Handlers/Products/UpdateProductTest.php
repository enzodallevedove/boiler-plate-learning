<?php

namespace Tests\Unit\Handlers\Products;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Commands\Products\UpdateProduct as CommandUpdateProduct;
use App\Services\Handlers\Products\UpdateProduct as HandlerUpdateProduct;
use Tests\TestCase;
use Illuminate\Container\Container as Application;

class UpdateProductTest extends TestCase
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
        $id = $model->id;

        $command = new CommandUpdateProduct($id,$data);
        $repository = new ProductRepository(Application::getInstance());
        $handler = new HandlerUpdateProduct($repository);

        $handle = $handler->handle($command);

        $this->assertEquals($id,$handle->id);
        $this->assertEquals($data['name'],$handle->name);
        $this->assertEquals($data['sku'],$handle->sku);
        $this->assertEquals($data['description'],$handle->description);
        $this->assertEquals($data['price'],$handle->price);
    }
}
