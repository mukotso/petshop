<?php

namespace App\Repositories\V1;

use App\Interfaces\V1\PaymentInterface;


class PaymentRepository implements PaymentInterface
{

    public function getAllPayments()
    {
    }

    public function createPayment(array $payment_details, $order_uuid)
    {
    }

}
