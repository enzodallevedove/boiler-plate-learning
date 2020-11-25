<?php

namespace App\Services\Commands\SaleItems;

use App\Contracts\CommandInterface;

class CreateSaleItem implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * CreateSaleItem constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
