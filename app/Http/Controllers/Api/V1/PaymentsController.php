<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\PaymentsRequest;
use App\Http\Resources\V1\PaymentResource;
use App\Interfaces\V1\PaymentInterface;
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

    /**
     * @OA\Get(
     * path="/payments",
     * summary="List all pyments",
     * description="view all pyments",
     * tags={"Payments"},
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
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
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * @OA\Post(
     * path="/payment/create",
     * summary="Create  a payment",
     * description=" create payment",
     * tags={"Payments"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required payment details",
     *    @OA\JsonContent(
     *       required={"title","details"},
     *       @OA\Property(property="type", type="string", example="cash"),
     *       @OA\Property(property="details", type="object", example={"address": "4035 O Reilly Causeway East Imaniton WY 32158-8199","last_name": "Corkery","first_name": "Karson"}
     *     ),
     *    ),
     * ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
     */
    public function create(PaymentsRequest $request)
    {
        try {
            $payment = $this->paymentRepository->createPayment($request->all());

            return response(
                [
                    'payment' => new PaymentResource($payment),
                    'message' => 'payment created successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     * path="/payment/{payment_uuid}",
     * summary="view payment",
     * description="view a payment",
     * tags={"Payments"},
     * @OA\Parameter(
     *          name="payment_uuid",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
     */
    public function show( $payment_uuid)
    {
        try {
            $payment = $this->paymentRepository->showPaymentDetails($payment_uuid);

            return response(
                [
                    'payment' => new PaymentResource($payment),
                    'message' => 'Payment details fetched  successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Update the specified resource in storage.
     */


    /**
     * @OA\Put(
     * path="/payment/{payment_uuid}",
     * summary="update payment",
     * description="update payment",
     * tags={"Payments"},
     * @OA\Parameter(
     *          name="payment_uuid",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required payment details",
     *    @OA\JsonContent(
     *       required={"title","details"},
     *       @OA\Property(property="type", type="string", example="bank transfer"),
     *       @OA\Property(property="details", type="object", example={"address": "4035 O Reilly Causeway East Imaniton WY 32158-8199","last_name": "Corkery","first_name": "Karson"}
     *     ),
     *    ),
     * ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
     */
    public function update(Request $request,  $payment_uuid)
    {
        try {
            $this->paymentRepository->updatePaymentDetails($request->all(), $payment_uuid);
            return response(
                [
                    'message' => 'payment details updated successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     * path="/payment/{payment_uuid}",
     * summary="delete payment",
     * description="delete a payment",
     * tags={"Payments"},
     * @OA\Parameter(
     *          name="payment_uuid",
     *          description="payment id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
     */
    public function destroy($payment_uuid)
    {
        try {
            $this->paymentRepository->deletePaymentDetails($payment_uuid);

            return response(
                [
                    'message' => 'Payment deleted successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
