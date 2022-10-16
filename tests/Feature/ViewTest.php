<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Sael');

        $this->get('/hello-again')
            ->assertSeeText('Hello Sael');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Sael');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Sael'])
            ->assertSeeText('Hello Sael');

        $this->view('hello.world', ['name' => 'Sael'])
            ->assertSeeText('World Sael');
    }


}
