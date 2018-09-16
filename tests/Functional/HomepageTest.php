<?php

namespace Tests\Functional;

class HelloTest extends BaseTestCase
{

    /**
     * Test that the index route with optional name argument returns a rendered greeting
     */
    public function testGetHello()
    {
        $response = $this->runApp('GET', '/Hello?User=Tanaka');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello, Tanaka', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHello()
    {
        $response = $this->runApp('POST', '/Hello', ['User' => 'Tanaka']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello, Tanaka', (string)$response->getBody());
    }
}