<?php
namespace App\Tests\Service;
use App\Entity\Product;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorTest extends KernelTestCase{

    protected function setUp() : void
    {
        $this->calculator = new Calculator();
    }

    public function testGetTotalHT(){
        $total = $this->calculator->getTotalHT($this->getProducts());

        $this->assertEquals(64, $total);
    }

    public function testGetTotalTTC(){
        $total= $this->calculator->getTotalTTC($this->getProducts(), 20);

        $this->assertEquals(76.8, $total);
    }

    public function getProducts(){
        return [
            [
                "product" => $this->createProduct("Ballon rouge", 10),
                "quantity" => 2
            ],
            [
                "product" => $this->createProduct("Ballon bleu", 8),
                "quantity" => 1
            ],
            [
                "product" => $this->createProduct("Ballon jaunz", 12),
                "quantity" => 3
            ]
            ];
    }

    public function createProduct($name, $price){
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        return $product;
    }
}