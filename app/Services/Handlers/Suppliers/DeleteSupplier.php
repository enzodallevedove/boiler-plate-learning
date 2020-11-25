<?php

namespace App\Services\Handlers\Suppliers;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SupplierRepository;

class DeleteSupplier implements HandlerInterface
{

    /**
     * @var SupplierRepository
     */
    protected $repository;

    /**
     * DeleteSupplier constructor.
     * @param SupplierRepository $repository
     */
    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CommandInterface $command
     * @return null|string
     * @throws Exception
     */
    public function handle(CommandInterface $command):? string
    {
        try {
            $this->repository->delete(
                $command->getSupplierId()
            );

            return 'Supplier successfully deleted.';
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
