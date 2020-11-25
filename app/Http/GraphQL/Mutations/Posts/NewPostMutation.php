<?php

namespace App\Http\GraphQL\Mutations\Posts;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Posts\CreatePost;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class NewPostMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewPost'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('post');
    }

    /**
     * @param array $args
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'title' => ['required'],
            'content' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::string()
            ],
        ];
    }


    /**
     * @param mixed $root
     * @param array $args
     * @return null|Object
     */
    public function resolve($root, array $args):? Object
    {
        return $this->dispatch(new CreatePost($args));
    }
}
