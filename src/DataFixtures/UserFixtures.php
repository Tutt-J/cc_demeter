<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= 3; $i++) {
            $user = new User();
            $user->setLastname('Lastname');
            $user->setFirstname('User' . $i );
            $user->setEmail("user". $i ."@mail.com");
            $user->setPassword(password_hash("123456", PASSWORD_DEFAULT));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
