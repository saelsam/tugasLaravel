<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Sael')
            ->assertSeeText('Hello Sael');

        $this->post('/input/hello', [
            'name' => 'Sael'
        ])->assertSeeText('Hello Sael');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Sael",
                "last" => "Sam"
            ]
        ])->assertSeeText("Hello Sael");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Sael",
                "last" => "Sam"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Sael")
            ->assertSeeText("Sam");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple 12 Pro Max",
                    "price" => 20000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple 12 Pro Max")
            ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Sael',
            'married' => 'true',
            'birth_date' => '2001-10-10'
        ])->assertSeeText('Sael')->assertSeeText("true")->assertSeeText("2001-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Sael",
                "middle" => "Sam",
                "last" => "Rudek"
            ]
        ])->assertSeeText("Sael")->assertSeeText("Rudek")
            ->assertDontSeeText("Sam");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Saelsam",
            "password" => "secret",
            "admin" => "true"
        ])->assertSeeText("Saelsam")->assertSeeText("secret")
            ->assertDontSeeText("admin");
    }


    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "ruru",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("ruru")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }


}
