<?php

namespace App\Services\Handlers\Posts;

use Exception;
use App\Contracts\CommandInterface;
use App\Contracts\HandlerInterface;
use App\Exceptions\HandlerException;
use App\Repositories\PostRepository;

class DeletePost implements HandlerInterface
{

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * DeletePost constructor.
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
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
                $command->getPostId()
            );

            return 'Post successfully deleted.';
        } catch (Exception $error) {
            throw new HandlerException($error->getMessage());
        }
    }
}
