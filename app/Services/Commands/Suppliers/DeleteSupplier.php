<?php

namespace App\Services\Commands\Suppliers;

use App\Contracts\CommandInterface;

class DeleteSupplier implements CommandInterface
{
    /**
     * @var int
     */
    protected $supplierId;

    /**
     * DeleteSupplier constructor.
     * @param int $supplierId
     */
    public function __construct(int $supplierId)
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplierId;
    }
}
