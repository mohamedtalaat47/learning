<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomePageTextDisplay()
    {
        $response = $this->get('/');

        $response->assertSeeText('Documentation');
        $response->assertSeeText('Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the');
    }
}
