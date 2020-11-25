<?php

namespace App\Services\Commands\Sales;

use App\Contracts\CommandInterface;

class GetSaleWhere implements CommandInterface
{
    /**
     * @var array
     */
    protected $where;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $with;

    /**
     * GetSaleWhere constructor.
     * @param array $where
     * @param array $columns
     * @param array $with
     */
    public function __construct(
        array $where,
        array $columns = ['*'],
        array $with = []
    ) {
        $this->where   = $where;
        $this->columns = $columns;
        $this->with    = $with;
    }

    /**
     * @return array
     */
    public function getWhere(): array
    {
        return $this->where;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getWith(): array
    {
        return $this->with;
    }
}
