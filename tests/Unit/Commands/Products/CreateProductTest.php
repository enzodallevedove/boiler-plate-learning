<?php

namespace Tests\Unit\Commands\Products;

use App\Product;
use App\Services\Commands\Products\CreateProduct;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    public function test_can_get_data()
    {
        $data = [
            'name' => $this->faker->sentence,
            'sku' => strtolower($this->faker->sentence),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(),
        ];

        $command = new CreateProduct($data);

        $commandGetData = $command->getData();

        $this->assertEquals($data['name'],$commandGetData['name']);
        $this->assertEquals($data['sku'],$commandGetData['sku']);
        $this->assertEquals($data['description'],$commandGetData['description']);
        $this->assertEquals($data['price'],$commandGetData['price']);
    }
}
