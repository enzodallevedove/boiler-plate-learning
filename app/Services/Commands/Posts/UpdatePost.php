<?php

namespace App\Services\Commands\Posts;

use App\Contracts\CommandInterface;

class UpdatePost implements CommandInterface
{
    /**
     * @var int
     */
    protected $postId;

    /**
     * @var array
     */
    protected $data;

    /**
     * UpdatePost constructor.
     * @param int $postId
     * @param array $data
     */
    public function __construct(int $postId, array $data)
    {
        $this->data = $data;
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
