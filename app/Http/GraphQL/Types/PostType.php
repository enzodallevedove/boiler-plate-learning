<?php

namespace App\Http\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Posts',
        'description' => 'A type',
        'model' => Post::class
    ];

    /**
     * define field of type
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the post'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of the post'
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'content of the post'
            ],
        ];
    }
}
