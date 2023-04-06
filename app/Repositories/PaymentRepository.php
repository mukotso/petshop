<?php

namespace App\Repositories;

use App\Interfaces\PaymentInterface;
use App\Models\Payment;


class PaymentRepository implements PaymentInterface
{

    public function getAllPayments()
    {
    }

    public function createPayment(array $payment_details, $order_uuid)
    {
    }

}
