<?php

namespace App\Interfaces;


interface PaymentInterface
{

    public function getAllPayments();

    public function createPayment($payment_details, $order_uuid);


}