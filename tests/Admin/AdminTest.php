<?php

namespace App\Tests\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminTest extends WebTestCase
{
    public function testAdminPath(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');

        dd($crawler);
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }
}
