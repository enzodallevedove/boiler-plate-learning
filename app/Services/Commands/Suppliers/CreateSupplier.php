<?php

namespace App\Services\Commands\Suppliers;

use App\Contracts\CommandInterface;

class CreateSupplier implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * CreateSupplier constructor.
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
