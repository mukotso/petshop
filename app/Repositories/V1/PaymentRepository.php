<?php

namespace App\Repositories\V1;

use App\Interfaces\V1\PaymentInterface;
use App\Models\Payment;


class PaymentRepository implements PaymentInterface
{

    public function getAllPayments()
    {
        return Payment::orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createPayment(array $payment_details)
    {
        return Payment::create($payment_details);
    }

    public function showPaymentDetails($payment_uuid)
    {
        return Payment::findorFail($payment_uuid);
    }

    public function updatePaymentDetails(array $payment_details, $payment_uuid)
    {
        $payment = Payment::findorFail($payment_uuid);
        $payment->update($payment_details);
        return $payment;
    }

    public function deletePaymentDetails($payment_uuid)
    {
        $payment = Payment::findorFail($payment_uuid);
        return $payment->delete();
    }

}
