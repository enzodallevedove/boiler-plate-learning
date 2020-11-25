<?php

namespace Tests\Unit\Commands\Products;

use App\Product;
use App\Services\Commands\Products\UpdateProduct;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    public function test_can_get_data()
    {
        $id = $this->faker->randomNumber();
        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new UpdateProduct($id,$data);

        $commandGetData = $command->getData();

        $this->assertEquals($data['name'], $commandGetData['name']);
        $this->assertEquals($data['sku'], $commandGetData['sku']);
        $this->assertEquals($data['description'], $commandGetData['description']);
        $this->assertEquals($data['price'], $commandGetData['price']);
    }

    public function test_can_get_product_id()
    {
        $id = $this->faker->randomNumber();

        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new UpdateProduct($id,$data);

        $commandGetId = $command->getProductId();

        $this->assertEquals($id, $commandGetId);
    }
}
