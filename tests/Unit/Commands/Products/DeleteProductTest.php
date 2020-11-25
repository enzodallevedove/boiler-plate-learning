<?php

namespace Tests\Unit\Commands\Products;

use App\Product;
use App\Services\Commands\Products\DeleteProduct;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{

    public function test_can_get_product_id()
    {
        $id = $this->faker->randomNumber();

        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new DeleteProduct($id,$data);

        $commandGetId = $command->getProductId();

        $this->assertEquals($id, $commandGetId);
    }
}
