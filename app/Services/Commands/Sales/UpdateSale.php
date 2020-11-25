<?php

namespace App\Services\Commands\Sales;

use App\Contracts\CommandInterface;

class UpdateSale implements CommandInterface
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
     * UpdateSale constructor.
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
    public function getSaleId(): int
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
