<?php

namespace App\Services\Handlers\Suppliers;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SupplierRepository;

class UpdateSupplier implements HandlerInterface
{

    /**
     * @var SupplierRepository
     */
    protected $repository;

    /**
     * UpdateSupplier constructor.
     * @param SupplierRepository $repository
     */
    public function __construct(SupplierRepository $repository)
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
                $command->getSupplierId()
            );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
