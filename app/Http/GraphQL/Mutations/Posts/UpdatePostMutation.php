<?php

namespace App\Http\GraphQL\Mutations\Posts;

use GraphQL\Type\Definition\Type;
use App\Services\Commands\Posts\UpdatePost;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Http\GraphQL\Mutations\BaseMutation;
use App\Http\GraphQL\Traits\AuthorizationTrait;

class UpdatePostMutation extends BaseMutation
{
    use AuthorizationTrait;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdatePost'
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
            'id' =>['required'],
        ];
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
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
        $postId = $args['id'];
        unset($args['id']);

        return $this->dispatch(new UpdatePost($postId, $args));
    }
}
