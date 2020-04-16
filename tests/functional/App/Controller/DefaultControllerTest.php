<?php

namespace Tests\functional\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 * @package Tests\functional\App\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndexTitle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains(
            'The Best Cars in the Internet!',
            $crawler->filter('title')->text()
        );
    }

    public function testOfferTitle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/our-cars');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertContains(
            'The Best Cars in the Internet!',
            $crawler->filter('title')->text());

        $link = $crawler->filter('a.font-weight-bold')
            ->eq(0)->link();

        $crawler = $client->click($link);
        $this->assertContains(
            'BMW X5',
            $crawler->filter('.product-title')->text()
        );
    }
}
