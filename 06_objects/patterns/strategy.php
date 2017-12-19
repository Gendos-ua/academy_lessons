<?php

# ПРОБЛЕМА

// Класс для оплаты через банковскую карту
class payByCC {

    private $ccNum = '';
    private $ccType = '';
    private $cvvNum = '';
    private $ccExpMonth = '';
    private $ccExpYear = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using Credit Card";
    }

}

// Класс для оплаты через PayPal
class payByPayPal {

    private $payPalEmail = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using PayPal";
    }

}

// Данный фрагмент вставляется везде, где необходима проверка.
$amount = 5000;
if($amount >= 500) {
    $pay = new payByCC();
    $pay->pay($amount);
} else {
    $pay = new payByPayPal();
    $pay->pay($amount);
}





# РЕШЕНИЕ


interface payStrategy {
    public function pay($amount);
}

class goodPayByCC implements payStrategy {

    private $ccNum = '';
    private $ccType = '';
    private $cvvNum = '';
    private $ccExpMonth = '';
    private $ccExpYear = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using Credit Card";
    }

}

class goodPayByPayPal implements payStrategy {

    private $payPalEmail = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using PayPal";
    }

}

class shoppingCart {

    public $amount = 0;

    public function __construct($amount = 0) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount = 0) {
        $this->amount = $amount;
    }

    public function payAmount() {
        if($this->amount >= 500) {
            $payment = new goodPayByCC();
        } else {
            $payment = new goodPayByPayPal();
        }

        $payment->pay($this->amount);
    }
}

$cart = new shoppingCart(499);
$cart->payAmount();

$cart = new shoppingCart(501);
$cart->payAmount();

