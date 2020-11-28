<?php

namespace Tests\Unit\Handlers\Sales;

use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;

use App\Repositories\SaleRepository;
use App\Services\Commands\Sales\DeleteSale as CommandDeleteSale;
use App\Services\Handlers\Sales\DeleteSale as HandlerDeleteSale;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Tests\TestCase;

class DeleteSaleTest extends TestCase
{
    public function testCanDeleteSale()
    {
        $sale = $this->CreateSale();

        $command = Mockery::mock(CommandDeleteSale::class);
        $command->shouldReceive('getSaleId')->andReturn($sale->id);

        $repository = new SaleRepository(Application::getInstance());

        $handler = new HandlerDeleteSale($repository);
        $handler->handle($command);

        try{
            Product::findOrFail($sale->id);
        }catch(ModelNotFoundException $e){
            $this->assertJson(json_encode(['Correct']));
        }
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
}
