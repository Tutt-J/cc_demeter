<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
    private $client;
    private $entityManager;
    protected function setUp():void
    {
        parent::setUp();

        $this->client= static::createClient();

        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    public function testRenderRegisterPage()
    {
        $this->client->request('GET', '/register');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inscription');
    }

    public function testSuccessfulRegister()
    {
        $this->client->request('GET', '/register');

        $crawler = $this->client->submitForm('Register', [
            'registration_form[firstname]' => 'Wyona',
            'registration_form[lastname]' => 'Quantin',
            'registration_form[email]' => 'test@test.com',
            'registration_form[plainPassword]' => 'azerty',

        ]);

        $this->assertResponseRedirects("/login");
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@test.com']);

        $this->assertNotNull($user);
    }

    protected function tearDown():void{
        parent::tearDown();
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@test.com']);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
        $this->client= null;
        $this->entityManager = null ;

    }
    
}
