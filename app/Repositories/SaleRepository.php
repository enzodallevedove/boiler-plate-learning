<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Sale::class;
    }
}
