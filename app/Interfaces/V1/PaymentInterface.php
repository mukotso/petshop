<?php

namespace App\Interfaces\V1;


interface PaymentInterface
{

    public function getAllPayments();

    public function createPayment(array $payment_details, $order_uuid);


}
