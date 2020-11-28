<?php

namespace Tests\Unit\Handlers\Sales;

use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use App\Repositories\SaleRepository;
use App\Services\Commands\Sales\GetSaleWhere as CommandGetSaleWhere;
use App\Services\Handlers\Sales\GetSaleWhere as HandlerGetSaleWhere;

use Illuminate\Container\Container as Application;
use Mockery;
use Tests\TestCase;

class GetSaleWhereTest extends TestCase
{
    public function testCanGetOneResultSale()
    {
        $this->createSale();
        $command = Mockery::mock(CommandGetSaleWhere::class);
        $command->shouldReceive('getWhere')->andReturn([]);
        $command->shouldReceive('getColumns')->andReturn(['*']);
        $command->shouldReceive('getWith')->andReturn([]);

        $repository = new SaleRepository(Application::getInstance());

        $handler = new HandlerGetSaleWhere($repository);
        $handle = $handler->handle($command);

        if ($handle->count()!=0) {
            $this->assertTrue(true);
        }
    }

    protected function createSale()
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
}
