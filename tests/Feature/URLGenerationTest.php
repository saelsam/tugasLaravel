<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Sael')
            ->assertSeeText("/url/current?name=Sael");
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText("/redirect/name/Sael");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }


}
