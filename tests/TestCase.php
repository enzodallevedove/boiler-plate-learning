<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    //use RefreshDatabase;


    protected $faker;

    public function setUp(): void {
        parent::setUp();
        $this->seed();
        $this->faker = Factory::create();
    }
}
