<?php

namespace App\Tests\Entity;
use App\Entity\User;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase{
    public function testOrderEntity(){
        $order= new Order();
        $order->setReference("az68ghip");
        $order->setTotalPrice(100);
        $order->setUser($this->getUser());

        $this->assertEquals("az68ghip", $order->getReference());
        $this->assertEquals(100, $order->getTotalPrice());
        $this->assertEquals("j.doe@mail.com", $order->getUser()->getEmail());

    }

    public function getUser(){
        $user = new User();
        $user->setEmail("j.doe@mail.com");
        return $user;
    }
}