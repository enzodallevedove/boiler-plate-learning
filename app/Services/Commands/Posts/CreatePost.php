<?php

namespace App\Services\Commands\Posts;

use App\Contracts\CommandInterface;

class CreatePost implements CommandInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * CreatePost constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
