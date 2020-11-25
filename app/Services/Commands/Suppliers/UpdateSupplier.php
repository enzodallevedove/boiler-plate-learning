<?php

namespace App\Services\Commands\Suppliers;

use App\Contracts\CommandInterface;

class UpdateSupplier implements CommandInterface
{
    /**
     * @var int
     */
    protected $supplierId;

    /**
     * @var array
     */
    protected $data;

    /**
     * UpdateSupplier constructor.
     * @param int $supplierId
     * @param array $data
     */
    public function __construct(int $supplierId, array $data)
    {
        $this->data = $data;
        $this->supplierId = $supplierId;
    }

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
