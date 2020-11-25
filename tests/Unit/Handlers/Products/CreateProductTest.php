<?php

namespace Tests\Unit\Handlers\Products;

use App\Repositories\ProductRepository;
use App\Services\Commands\Products\CreateProduct as CommandCreateProduct;
use App\Services\Handlers\Products\CreateProduct as HandlerCreateProduct;
use Tests\TestCase;
use Illuminate\Container\Container as Application;

class CreateProductTest extends TestCase
{
    public function test_can_handle()
    {
        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new CommandCreateProduct($data);
        $repository = new ProductRepository(Application::getInstance());
        $handler = new HandlerCreateProduct($repository);
        $handle = $handler->handle($command);

        $this->assertTrue(isset($handle->id));
        $this->assertEquals($data['name'],$handle->name);
        $this->assertEquals($data['sku'],$handle->sku);
        $this->assertEquals($data['description'],$handle->description);
        $this->assertEquals($data['price'],$handle->price);
    }
}
