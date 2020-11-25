<?php

namespace App\Services\Handlers\Posts;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\PostRepository;

class CreatePost implements HandlerInterface
{

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * CreatePost constructor.
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
    public function handle(CommandInterface $command):? Object
    {
        try {
            return $this->repository->create($command->getData());
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
