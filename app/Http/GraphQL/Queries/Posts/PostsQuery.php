<?php

namespace App\Http\GraphQL\Queries\Posts;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use App\Http\GraphQL\Queries\BaseQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Services\Commands\Posts\GetPostWhere;

class PostsQuery extends BaseQuery
{
    /**
     * @var array
     */
    protected $attributes = [
        'title' => 'Post Title',
        'content' => 'Text of the Post'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        // result of query with pagination laravel
        return Type::listOf(GraphQL::type('post'));
    }

    /**
     * arguments to filter query
     *
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
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
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Collection
     */
    public function resolve(
        $root,
        array $args,
        $context,
        ResolveInfo $resolveInfo,
        Closure $getSelectFields
    ): Collection {
        $with = collect([]);
        $where = collect([]);

        foreach ($context->getRelations() as $roleName => $field) {
            if ($roleName === 'role') {
                $with->push($roleName);
            }
        }

        if (isset($args['id'])) {
            $where->put('id', $args['id']);
        }

        return $this->dispatch(new GetPostWhere(
            $where->toArray(),
            ['*'],
            $with->toArray()
        ));
    }
}
