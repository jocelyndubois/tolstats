<?php

namespace StatBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatsControllerTest extends WebTestCase
{
    public function testUserstats()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/player/{player}');
    }

    public function testGlobalstats()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/global/stats');
    }

}
