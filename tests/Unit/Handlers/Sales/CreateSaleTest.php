<?php

namespace Tests\Unit\Handlers\Sales;

use App\Models\Role;
use App\Models\User;
use App\Repositories\SaleRepository;
use App\Services\Commands\Sales\CreateSale as CommandCreateSale;
use App\Services\Handlers\Sales\CreateSale as HandlerCreateSale;

use Illuminate\Container\Container as Application;
use Mockery;
use Tests\TestCase;

class CreateSaleTest extends TestCase
{
    public function testCanCreateProduct()
    {
        $command = Mockery::mock(CommandCreateSale::class);
        $command->shouldReceive('getData')->andReturn([
            "status" => "pendent",
            "grand_total" => number_format($this->faker->randomFloat(), 2, '.', ''),
            "user_id" => $this->getUserId(),
        ]);

        $repository = new SaleRepository(Application::getInstance());

        $handler = new HandlerCreateSale($repository);
        $handle = $handler->handle($command);
        $this->assertTrue(isset($handle->id));
        $this->assertSame($command->getData()['status'],$handle->status);
        $this->assertSame($command->getData()['grand_total'],$handle->grand_total);
        $this->assertSame($command->getData()['user_id'],$handle->user_id);
    }

    protected function getUserId(){
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
}
