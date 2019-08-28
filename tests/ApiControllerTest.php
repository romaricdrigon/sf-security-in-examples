<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testAuthenticationFailure()
    {
        $client = static::createClient();
        $client->request('GET', '/api/blogs');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testBlogsApi()
    {
        $client = static::createClient();
        $client->request('GET', '/api/blogs', [], [], [
            'HTTP_Authorization' => 'TESTAPIKEY',
        ]);

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(2, count($json));
        $this->assertEquals('Web Summer Camp official blog', $json[0]['name']);
    }
}
