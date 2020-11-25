<?php

namespace App\Services\Handlers\Sales;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SaleRepository;

class CreateSale implements HandlerInterface
{

    /**
     * @var SaleRepository
     */
    protected $repository;

    /**
     * CreateSale constructor.
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
    public function handle(CommandInterface $command):? Object
    {
        try {
            return $this->repository->create($command->getData());
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
