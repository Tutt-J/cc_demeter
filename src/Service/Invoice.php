<?php
namespace App\Service;

class Invoice{

    public function __construct(
        private EmailService $emailService,
    ) {
    }
    function process($email, $amount){
        return $this->emailService->send($email, "Votre commande d’un montant de ".$amount."€ est confirmée");
    }
}