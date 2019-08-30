<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'fr/artist/');

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();
        $this->assertContains('Artist', $crawler->filter('h1')->text());

        $link = $crawler->selectLink('show')->link();
        $crawler = $client->click($link);

        $this->assertSame('398', $crawler->filter('td')->text());
    }
}
