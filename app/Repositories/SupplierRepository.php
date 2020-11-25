<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Supplier::class;
    }
}
