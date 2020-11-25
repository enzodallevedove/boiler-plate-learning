<?php

namespace Tests\Unit\Commands\Products;

use App\Product;
use App\Services\Commands\Products\GetProductWhere;
use Tests\TestCase;

class GetProductWhereTest extends TestCase
{
    public function test_can_get_where()
    {
        $fields = ['id', 'name', 'sku', 'description', 'price'];
        $usedFields = [];
        $where = [];
        foreach ($fields as $field) {
            if ($this->faker->randomNumber() % 2) {
                switch ($field) {
                    case 'id':
                        $where[$field] = $this->faker->randomNumber();
                        break;
                    case 'name':
                        $where[$field] = $this->faker->sentence;
                        break;
                    case 'sku':
                        $where[$field] = strtolower($this->faker->sentence);
                        break;
                    case 'description':
                        $where[$field] = $this->faker->paragraph;
                        break;
                    case 'price':
                        $where[$field] = $this->faker->randomFloat();
                }
                $usedFields[] = $field;
            }
        }
        $command = new GetProductWhere($where);

        $commandGetWhere = $command->getWhere();
        foreach ($usedFields as $usedField) {
            $this->assertEquals($where[$usedField], $commandGetWhere[$usedField]);
        }
    }

    public function test_can_get_columns()
    {
        $columns = [
            '*'
        ];
        $command = new GetProductWhere([], $columns);

        $commandGetColumns = $command->getColumns();
        $this->assertEquals($columns, $commandGetColumns);
    }

    public function test_can_get_with()
    {
        $with = [];
        $command = new GetProductWhere([], ['*'], $with);

        $commandGetWith = $command->getWith();
        $this->assertEquals($with, $commandGetWith);
    }
}
