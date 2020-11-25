<?php

namespace App\Services\Handlers\Products;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\ProductRepository;

class UpdateProduct implements HandlerInterface
{

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * UpdateProduct constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
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
                $command->getProductId()
            );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
