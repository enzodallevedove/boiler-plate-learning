<?php

namespace App\Services\Commands\Sales;

use App\Contracts\CommandInterface;

class CreateSale implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * CreateSale constructor.
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
