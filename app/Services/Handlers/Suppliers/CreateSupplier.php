<?php

namespace App\Services\Handlers\Suppliers;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SupplierRepository;

class CreateSupplier implements HandlerInterface
{

    /**
     * @var SupplierRepository
     */
    protected $repository;

    /**
     * CreateSupplier constructor.
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
    public function handle(CommandInterface $command):? Object
    {
        try {
            return $this->repository->create($command->getData());
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
