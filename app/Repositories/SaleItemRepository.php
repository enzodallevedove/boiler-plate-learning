<?php

namespace App\Repositories;

use App\Models\SaleItem;

class SaleItemRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return SaleItem::class;
    }
}
