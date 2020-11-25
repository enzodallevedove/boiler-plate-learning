<?php

namespace Tests\Unit\Handlers\Products;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Commands\Products\DeleteProduct as CommandDeleteProduct;
use App\Services\Handlers\Products\DeleteProduct as HandlerDeleteProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Container\Container as Application;

class DeleteProductTest extends TestCase
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

        $command = new CommandDeleteProduct($id);
        $repository = new ProductRepository(Application::getInstance());
        $handler = new HandlerDeleteProduct($repository);

        $handler->handle($command);

        try{
            Product::findOrFail($id);
        }catch(ModelNotFoundException $e){
            $this->assertJson(json_encode(['Correct']));
        }
    }
}
