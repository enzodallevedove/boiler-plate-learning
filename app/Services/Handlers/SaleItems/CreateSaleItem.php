<?php

namespace App\Services\Handlers\SaleItems;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SaleItemRepository;

class CreateSaleItem implements HandlerInterface
{

    /**
     * @var SaleItemRepository
     */
    protected $repository;

    /**
     * CreateSaleItem constructor.
     * @param SaleItemRepository $repository
     */
    public function __construct(SaleItemRepository $repository)
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
