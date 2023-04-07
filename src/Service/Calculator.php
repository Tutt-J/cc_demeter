<?php
namespace App\Service;

class Calculator{
    public function getTotalHT($products){
        $total=0;
        foreach($products as $product){
            $total+=$product['product']->getPrice()*$product['quantity'];
        }
        return $total;
    }

    public function getTotalTTC($products, $tva){
        $total=$this->getTotalHT($products);
        return $total + $total*($tva/100);
    }
}