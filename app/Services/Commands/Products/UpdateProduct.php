<?php

namespace App\Services\Commands\Products;

use App\Contracts\CommandInterface;

class UpdateProduct implements CommandInterface
{
    /**
     * @var int
     */
    protected $productId;

    /**
     * @var array
     */
    protected $data;

    /**
     * UpdateProduct constructor.
     * @param int $productId
     * @param array $data
     */
    public function __construct(int $productId, array $data)
    {
        $this->data = $data;
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
