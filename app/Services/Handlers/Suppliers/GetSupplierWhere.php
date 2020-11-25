<?php

namespace App\Services\Handlers\Suppliers;

use Exception;
use Illuminate\Support\Collection;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SupplierRepository;

class GetSupplierWhere implements HandlerInterface
{
    /**
     * @var SupplierRepository
     */
    protected $repository;

    /**
     * GetSupplierWhere constructor.
     * @param SupplierRepository $repository
     */
    public function __construct(SupplierRepository $repository)
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
