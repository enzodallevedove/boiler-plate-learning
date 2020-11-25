<?php

namespace App\Services\Handlers\Sales;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\SaleRepository;

class DeleteSale implements HandlerInterface
{

    /**
     * @var SaleRepository
     */
    protected $repository;

    /**
     * DeleteSale constructor.
     * @param SaleRepository $repository
     */
    public function __construct(SaleRepository $repository)
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
                $command->getSaleId()
            );

            return 'Sale successfully deleted.';
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
