<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\OrderStatusesRequest;
use App\Http\Resources\V1\OrderStatusResource;
use App\Interfaces\V1\OrderStatusInterface;
use Illuminate\Support\Facades\Log;

class OrderStatusesController extends Controller
{

    protected OrderStatusInterface $orderStatusRepository;

    public function __construct(OrderStatusInterface $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orderStatus = $this->orderStatusRepository->getAllOrderStatuses();

            return response(
                [
                    'orderStatus' => OrderStatusResource::collection($orderStatus),
                    'message' => 'Order statuses Retrieved successfully'
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
    public function create(OrderStatusResource $request)
    {
        try {
             $this->orderStatusRepository->createOrderStatus($request->all());

            return response(
                [
                    [],
                    'message' => 'Order statuses added successfully'
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
    public function show($order_status_uuid)
    {
        try {
            $order = $this->orderStatusRepository->showOrderStatusDetails($order_status_uuid);

            return response(
                [
                    'order' => new OrderStatusResource($order),
                    'message' => 'order status fetched successfully'
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
    public function update(OrderStatusesRequest $request,  $order_status_uuid)
    {
        try {
            $this->orderStatusRepository->updateOrderStatusDetails($request->all(), $order_status_uuid);
            return response(
                [
                    [],
                    'message' => 'order status details updated successfully'
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
    public function destroy( $order_status_uuid)
    {
        try {
            $this->orderStatusRepository->deleteOrderStatus($order_status_uuid);

            return response(
                [
                    [],
                    'message' => 'order status deleted successfully'
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
