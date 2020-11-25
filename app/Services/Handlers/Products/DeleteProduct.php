<?php

namespace App\Services\Handlers\Products;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\ProductRepository;

class DeleteProduct implements HandlerInterface
{

    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * DeleteProduct constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
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
                $command->getProductId()
            );

            return 'Product successfully deleted.';
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
