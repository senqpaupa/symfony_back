<?php

namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Интеграционные тесты для CottageController
 */
class CottageControllerTest extends WebTestCase
{

    public function testGetAvailableCottages(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/cottages/available');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($data);
    }
} 