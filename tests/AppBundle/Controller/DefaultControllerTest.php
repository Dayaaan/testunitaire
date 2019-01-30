<?php

namespace Tests\AppBundle\Controller;


use AppBundle\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());

        $this->assertContains('Symfony',$client->getResponse()->getContent());
    }

    public function testAdd() {

        $calculator = new DefaultController();
        $result = $calculator->addAction(30, 12);

        $this->assertEquals(42, $result);
    }

    public function testTwig() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/test');
        $link = $crawler
            ->filter('a:contains("Super")') // find all links with the text "Greet"
            ->eq(1) // select the second link in the list
            ->link()
        ;

        // and click it
        $crawler = $client->click($link);
        $this->assertContains('Symfony',$client->getResponse()->getContent());
    }
    // public function testShowPost()
    // {
    //     $client = static::createClient();

    //     $crawler = $client->request('GET', '/test');

    //     $this->assertGreaterThan(
    //         0,
    //         $crawler->filter('html:contains("Hello World")')->count()
    //     );
    // }
}
