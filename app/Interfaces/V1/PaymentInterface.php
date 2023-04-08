<?php

namespace App\Interfaces\V1;


interface PaymentInterface
{

    public function getAllPayments();

    public function createPayment(array $payment_details);

    public function showPaymentDetails( $payment_uuid);

    public function updatePaymentDetails(array $payment_details, $payment_uuid);

    public function deletePaymentDetails( $payment_uuid);
}
