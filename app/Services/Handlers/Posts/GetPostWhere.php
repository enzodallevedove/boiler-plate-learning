<?php

namespace App\Services\Handlers\Posts;

use Exception;
use Illuminate\Support\Collection;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\PostRepository;

class GetPostWhere implements HandlerInterface
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * GetPostWhere constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
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
