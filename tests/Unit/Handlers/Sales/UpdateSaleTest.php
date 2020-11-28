<?php

namespace Tests\Unit\Handlers\Sales;

use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use App\Repositories\SaleRepository;
use App\Services\Commands\Sales\UpdateSale as CommandUpdateSale;
use App\Services\Handlers\Sales\UpdateSale as HandlerUpdateSale;

use Illuminate\Container\Container as Application;
use Mockery;
use Tests\TestCase;

class UpdateSaleTest extends TestCase
{
    public function testCanUpdateSale()
    {
        $sale = $this->createSale();

        $command = Mockery::mock(CommandUpdateSale::class);
        $command->shouldReceive('getSaleId')->andReturn($sale->id);
        $command->shouldReceive('getData')->andReturn([
            "status" => "completed",
            "grand_total" => number_format($this->faker->randomFloat(), 2, '.', ''),
            "user_id" => $this->getNewUserId(),
        ]);

        $repository = new SaleRepository(Application::getInstance());

        $handler = new HandlerUpdateSale($repository);
        $handle = $handler->handle($command);
        $this->assertSame($sale->id,$handle->id);
        $this->assertNotSame($sale->status,$handle->status);
        $this->assertNotSame($sale->grand_total,$handle->grand_total);
        $this->assertNotSame($sale->user_id,$handle->user_id);
        $this->assertSame($command->getSaleId(), $handle->id);
        $this->assertSame($command->getData()['status'], $handle->status);
        $this->assertSame($command->getData()['grand_total'], $handle->grand_total);
        $this->assertSame($command->getData()['user_id'], $handle->user_id);
    }

    protected function CreateSale()
    {
        return Sale::create([
            "status" => "pendent",
            "grand_total" => number_format($this->faker->randomFloat(), 2, '.', ''),
            "user_id" => $this->getUserId(),
        ]);
    }

    protected function getUserId()
    {
        return $this->createUser()->id;
    }

    protected function createUser()
    {
        $role = Role::create([
            'name' => 'admin',
        ]);

        return User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@gmail.com.br',
            'image' => '---',
            'password' => bcrypt('Admin123@'),
            'role_id' => $role->id
        ]);
    }

    protected function getNewUserId()
    {
        $role = Role::create([
            'name' => 'NewAdmin',
        ]);

        return User::create([
            'name' => 'New Admin User',
            'username' => 'newadmin',
            'email' => 'newadmin@gmail.com.br',
            'image' => '---',
            'password' => bcrypt('Admin123@'),
            'role_id' => $role->id
        ])->id;
    }
}
