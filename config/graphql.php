<?php

declare(strict_types=1);

use App\Http\GraphQL\Mutations\Posts\DeletePostMutation;
use App\Http\GraphQL\Mutations\Posts\NewPostMutation;
use App\Http\GraphQL\Mutations\Posts\UpdatePostMutation;
use App\Http\GraphQL\Mutations\Products\DeleteProductMutation;
use App\Http\GraphQL\Mutations\Products\NewProductMutation;
use App\Http\GraphQL\Mutations\Products\UpdateProductMutation;
use App\Http\GraphQL\Mutations\Sales\DeleteSaleMutation;
use App\Http\GraphQL\Mutations\Sales\NewSaleMutation;
use App\Http\GraphQL\Mutations\Sales\UpdateSaleMutation;
use App\Http\GraphQL\Queries\Posts\PostsQuery;
use App\Http\GraphQL\Queries\Products\ProductsQuery;
use App\Http\GraphQL\Queries\Sales\SalesQuery;
use App\Http\GraphQL\Types\PostType;
use App\Http\GraphQL\Types\ProductType;
use App\Http\GraphQL\Types\SaleItemInputType;
use App\Http\GraphQL\Types\SaleItemType;
use App\Http\GraphQL\Types\SaleType;
use App\Http\GraphQL\Types\UserType;
use App\Http\GraphQL\Types\RoleType;
use App\Http\GraphQL\Types\TokenType;
use App\Http\GraphQL\Queries\Users\UsersQuery;
use App\Http\GraphQL\Queries\Roles\RolesQuery;
use App\Http\GraphQL\Formatters\ErrorFormatter;
use App\Http\GraphQL\Queries\Users\UserInfosQuery;
use App\Http\GraphQL\Mutations\Users\LogInMutation;
use App\Http\GraphQL\Mutations\Users\NewUserMutation;
use App\Http\GraphQL\Mutations\Users\UpdateUserMutation;
use App\Http\GraphQL\Mutations\Users\DeleteUserMutation;
use App\Http\GraphQL\Mutations\Users\RefreshTokenMutation;
use App\Http\GraphQL\Mutations\Users\UpdateUserPasswordMutation;
use App\Http\GraphQL\Queries\Suppliers\SuppliersQuery;
use App\Http\GraphQL\Types\SupplierType;
use App\Http\GraphQL\Mutations\Suppliers\NewSupplierMutation;
use App\Http\GraphQL\Mutations\Suppliers\UpdateSupplierMutation;
use App\Http\GraphQL\Mutations\Suppliers\DeleteSupplierMutation;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\Http\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\Http\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\Http\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                // Users
                'users' => UsersQuery::class,
                'userInfos' => UserInfosQuery::class,
                // Users
                'roles' => RolesQuery::class,
                //Suppliers
                'suppliers' => SuppliersQuery::class,
                //Products
                'products' => ProductsQuery::class,
                //
                'sales' => SalesQuery::class,
                //
                'posts' => PostsQuery::class,
            ],
            'mutation' => [
                // Users
                'logIn' => LogInMutation::class,
                'newUser' => NewUserMutation::class,
                'deleteUser' => DeleteUserMutation::class,
                'updateUser' => UpdateUserMutation::class,
                'refreshToken' => RefreshTokenMutation::class,
                'updateUserPassword' => UpdateUserPasswordMutation::class,
                // Suppliers
                'newSupplier' => NewSupplierMutation::class,
                'updateSupplier' => UpdateSupplierMutation::class,
                'deleteSupplier' => DeleteSupplierMutation::class,
                //
                'newProduct' => NewProductMutation::class,
                'updateProduct' => UpdateProductMutation::class,
                'deleteProduct' => DeleteProductMutation::class,
                //
                'newSale' => NewSaleMutation::class,
                'updateSale' => UpdateSaleMutation::class,
                'deleteSale' => DeleteSaleMutation::class,
                //
                'newPost' => NewPostMutation::class,
                'updatePost' => UpdatePostMutation::class,
                'deletePost' => DeletePostMutation::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\Http\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'role' => RoleType::class,
        'user' => UserType::class,
        'token' => TokenType::class,
        'supplier' => SupplierType::class,
        'product' => ProductType::class,
        'sale' => SaleType::class,
        'saleItem' => SaleItemType::class,
        'saleItemInput' => SaleItemInputType::class,
        'post' => PostType::class,
    ],

    // The types will be loaded on demand. Default is to load all types on each request
    // Can increase performance on schemes with many types
    // Presupposes the config type key to match the type class name property
    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => [ErrorFormatter::class, 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0
];
