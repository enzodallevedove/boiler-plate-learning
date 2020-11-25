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
    public function testCanHandle()
    {
        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $model = Product::create($data);
        $id = $model->id;

        $newData = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new CommandUpdateProduct($id,$newData);
        $repository = new ProductRepository(Application::getInstance());
        $handler = new HandlerUpdateProduct($repository);

        $handle = $handler->handle($command);

        $this->assertEquals($id,$handle->id);
        $this->assertEquals($newData['name'],$handle->name);
        $this->assertEquals($newData['sku'],$handle->sku);
        $this->assertEquals($newData['description'],$handle->description);
        $this->assertEquals($newData['price'],$handle->price);
    }
}
