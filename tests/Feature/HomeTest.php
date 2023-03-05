<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomePage(): void
    {
        $response = $this->get('/home');

        $response->assertSeeText('Home page');
        $response->assertSeeText('Learn Laravel 9!');
    }

    public function testAboutPage(): void
    {
        $response = $this->get('/about');
        $response->assertSeeText('About page');
    }
}
