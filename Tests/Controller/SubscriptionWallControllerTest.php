<?php

namespace Integrated\Bundle\SubscriptionBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SubscriptionWallControllerTest {
    public function testIndex()
    {
        static::createClient();
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
        $this->assertEquals(10,10);

    }
}
?>