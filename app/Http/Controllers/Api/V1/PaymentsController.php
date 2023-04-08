<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\PaymentsRequest;
use App\Http\Resources\V1\PaymentResource;
use App\Interfaces\V1\PaymentInterface;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{

    protected PaymentInterface $paymentRepository;

    public function __construct(PaymentInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $payments = $this->paymentRepository->getAllPayments();

            return response(
                [
                    'payments' => PaymentResource::collection($payments),
                    'message' => 'payments Retrieved successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PaymentsRequest $request)
    {
        try {
            $this->paymentRepository->createPayment($request->all());

            return response(
                [
                    [],
                    'message' => 'payment created successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Display the specified resource.
     */
    public function show( $payment_uuid)
    {
        try {
            $payment = $this->paymentRepository->showPaymentDetails($payment_uuid);

            return response(
                [
                    'payment' => new PaymentsRequest($payment),
                    'message' => 'Payment details fetched  successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $payment_uuid)
    {
        try {
            $this->paymentRepository->updatePaymentDetails($request->all(), $payment_uuid);
            return response(
                [
                    [],
                    'message' => 'payment details updated successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($payment_uuid)
    {
        try {
            $this->paymentRepository->deletePaymentDetails($payment_uuid);

            return response(
                [
                    [],
                    'message' => 'Payment deleted successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
