<?php

namespace App\Services\Commands\Products;

use App\Contracts\CommandInterface;

class DeleteProduct implements CommandInterface
{
    /**
     * @var int
     */
    protected $productId;

    /**
     * DeleteProduct constructor.
     * @param int $productId
     */
    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}
