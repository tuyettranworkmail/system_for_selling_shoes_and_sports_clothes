<?php
namespace App\Controller;

class CheckoutController {
    public function index() {
        require __DIR__ . '/../Views/checkout.php';
    }

    public function success() {
        require __DIR__ . '/../Views/checkout-success.php';
    }

}