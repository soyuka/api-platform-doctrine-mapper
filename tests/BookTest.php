<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class BookTest extends ApiTestCase
{
    public function testGet(): void
    {
        static::createClient()->request('GET', '/api/books');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['hydra:member' => [['@id' => '/api/books/1']]]);
    }

    public function testPut(): void
    {
        static::createClient()->request('PATCH', '/api/books/1', [
            'json' => ['title' => 'forbidden'],
            'headers' => ['content-type' => 'application/merge-patch+json']
        ]);

        $this->assertJsonContains(['title' => 'forbidden']);
    }
}
