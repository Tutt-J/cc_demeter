<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    private $client;
    protected function setUp():void
    {
        parent::setUp();

        $this->client= static::createClient();
    }
    public function testLoginPageIsRender()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Se connecter');
    }

    public function testSuccessfulLogin()
    {
        $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('login', [
            '_username' => 'user0@mail.com',
            '_password' => '123456'
        ]);

        $this->assertResponseRedirects();
        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('h1', "Vous êtes connecté(e)");
        $this->assertSelectorTextContains('a', "Se déconnecter");
    }

    public function testWrongLogin()
    {
        $this->client->request('GET', '/login');

        $crawler = $this->client->submitForm('login', [
            '_username' => 'user0@mail.com',
            '_password' => 'azerty'
        ]);

        $this->assertResponseStatusCodeSame(302);
        $crawler = $this->client->followRedirect();

        $this->assertSelectorTextContains('div', "Invalid credentials.");
    }
    
}
