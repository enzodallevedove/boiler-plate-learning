<?php

namespace App\Services\Handlers\Posts;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\PostRepository;

class UpdatePost implements HandlerInterface
{

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * UpdatePost constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
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
                $command->getPostId()
            );
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
