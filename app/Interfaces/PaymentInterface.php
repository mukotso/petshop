<?php

namespace App\Interfaces;


interface PaymentInterface
{

    public function getAllPayments();

    public function createPayment(array $payment_details, $order_uuid);


}
