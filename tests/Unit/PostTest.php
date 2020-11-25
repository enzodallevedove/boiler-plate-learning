<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    protected $_TOKEN;

    public function Graphql(string $query)
    {
        return ($this->post('/graphql', [
            'query' => $query
        ], ['Authorization' => 'Bearer ' . $this->getToken()]));
    }

    public function test_can_create_post(): void
    {
        $data = [
            "title" => $this->faker->sentence,
            "content" => $this->faker->paragraph,
        ];
        $response = $this->Graphql(sprintf('
            mutation {
                newPost (title: "%s",content: "%s"){
                    title,content
                }
            }
        ', $data['title'], $data['content']));

        $this->assertEquals($data['title'],$response['data']['newPost']['title']);
        $this->assertEquals($data['content'],$response['data']['newPost']['content']);
        $response->assertStatus($response->getStatusCode());
    }

    protected function getToken()
    {
        echo $this->_TOKEN;
        if (isset($this->_TOKEN))
            return $this->_TOKEN;

        $token = auth()->attempt([
                'email' => 'admin@gmail.com.br',
                'password' => 'Admin123@',
            ]
        );

        $this->_TOKEN = $token;
        return $this->_TOKEN;
    }
}
