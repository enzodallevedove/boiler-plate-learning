<?php

namespace App\Services\Handlers\Sales;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SaleRepository;

class UpdateSale implements HandlerInterface
{

    /**
     * @var SaleRepository
     */
    protected $repository;

    /**
     * UpdateSale constructor.
     * @param SaleRepository $repository
     */
    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return null|Object
     * @throws Exception
     */
    public function handle(CommandInterface $command): ?object
    {
        try {
            return $this->repository->update(
                $command->getData(),
                $command->getSaleId()
            );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
