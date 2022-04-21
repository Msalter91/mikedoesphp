<?php

interface PaymentInterface {
    public function payNow();
    public function paymentProcess(); // This sets the rules for everything using this interface
}

interface OnlinePaymentInterface {
    public function login();
    public function logout();
}

class Paypal implements PaymentInterface, OnlinePaymentInterface { // implementing two interfaces at once
    public function paynow(){}
    public function login(){}
    public function logout(){}
    public function paymentProcess() {
        $this->login();
        $this->logout();
        $this->paynow();
    }
}

class Visa implements PaymentInterface { 
    public function paynow(){
    }
    public function paymentProcess() {
        $this->paynow();
    }
}

class Cash implements PaymentInterface {
    public function paynow(){
    }
    public function paymentProcess() {
        $this->paynow();
    }
}

// class MagicBeans implements PaymentInterface { // this would error as it does not fullow the rules of the interface
//     public function giveBeans(){
//     }
//     public function paymentProcess() {
//         $this->giveBeans();
//     }
// }

class BankTransfer implements PaymentInterface, OnlinePaymentInterface {
    public function payNow(){}
    public function login(){}
    public function logout(){}
    public function paymentProcess() {
        $this->login();
        $this->logout();
        $this->paynow();
}
}

class BuyProduct {
    public function pay(PaymentInterface $paymentType) { // By using interface, it allows us to pass a group of objects with strict 
                                                         // typing ensuring that the objects contain the right properties/methods
        $paymentType->paymentProcess();
    }
}

$paymentType = new Cash();
$buyProduct = new BuyProduct();

$buyProduct->pay($paymentType);