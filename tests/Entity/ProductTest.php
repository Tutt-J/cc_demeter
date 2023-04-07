<?php

namespace App\Tests\Entity;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase{
    public function testProductEntity(){
        $product = new Product();
        $product->setName("Ballon rouge");
        $product->setPrice(10);

        $this->assertEquals("Ballon rouge", $product->getName());
        $this->assertEquals(10, $product->getPrice());
    }
}