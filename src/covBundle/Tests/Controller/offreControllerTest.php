<?php

namespace covBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class offreControllerTest extends WebTestCase
{
    public function testDisplay_offre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/display_offre');
    }

    public function testAdd_offre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add_offre');
    }

    public function testUpdate_offre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/update_offre');
    }

    public function testDelete_offre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete_offre');
    }

}
