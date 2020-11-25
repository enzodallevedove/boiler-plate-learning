<?php

namespace App\Services\Commands\Products;

use App\Contracts\CommandInterface;

class CreateProduct implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * CreateProduct constructor.
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
