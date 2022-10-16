<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Sael', $firstName);
        self::assertEquals('Sam', $lastName);
        self::assertEquals('saelsam@gmail.com', $email);
        self::assertEquals('https://www.saelsam.com', $web);
    }

}
