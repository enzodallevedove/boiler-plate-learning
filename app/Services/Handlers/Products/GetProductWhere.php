<?php

namespace App\Services\Handlers\Products;

use Exception;
use Illuminate\Support\Collection;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\ProductRepository;

class GetProductWhere implements HandlerInterface
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * GetProductWhere constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
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
