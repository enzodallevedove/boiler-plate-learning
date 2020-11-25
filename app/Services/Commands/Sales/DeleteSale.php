<?php

namespace App\Services\Commands\Sales;

use App\Contracts\CommandInterface;

class DeleteSale implements CommandInterface
{
    /**
     * @var int
     */
    protected $saleId;

    /**
     * DeleteSale constructor.
     * @param int $saleId
     */
    public function __construct(int $saleId)
    {
        $this->saleId = $saleId;
    }

    /**
     * @return int
     */
    public function getSaleId(): int
    {
        return $this->saleId;
    }
}
