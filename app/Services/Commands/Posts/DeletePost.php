<?php

namespace App\Services\Commands\Posts;

use App\Contracts\CommandInterface;

class DeletePost implements CommandInterface
{
    /**
     * @var int
     */
    protected $postId;

    /**
     * DeletePost constructor.
     * @param int $postId
     */
    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }
}
