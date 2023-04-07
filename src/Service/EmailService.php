<?php
namespace App\Service;

class EmailService{
    public function send($email, $message){
        return (bool) mt_rand(0,1);
    }
}