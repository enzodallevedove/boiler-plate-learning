<?php

namespace App\Services\Handlers\Sales;

use Exception;
use Illuminate\Support\Collection;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SaleRepository;

class GetSaleWhere implements HandlerInterface
{
    /**
     * @var SaleRepository
     */
    protected $repository;

    /**
     * GetSaleWhere constructor.
     * @param SaleRepository $repository
     */
    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return Collection
     * @throws HandlerException
     */
    public function handle(CommandInterface $command): Collection
    {
        try {
            return $this->repository
                ->with($command->getWith())
                ->findWhere(
                    $command->getWhere(),
                    $command->getColumns()
                );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
