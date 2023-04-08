<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\V1\OrderResource;
use App\Interfaces\V1\OrderInterface;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    protected OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = $this->orderRepository->getAllOrders();

            return response(
                [
                    'orders' => OrderResource::collection($orders),
                    'message' => 'Orders Retrieved successfully'
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
    public function create(OrderRequest $request)
    {
        try {
            $this->orderRepository->createOrder($request->all());

            return response(
                [
                    [],
                    'message' => 'Order created successfully'
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
    public function show($order_uuid)
    {
        try {
            $order = $this->orderRepository->showOrderDetails($order_uuid);

            return response(
                [
                    'order' => new OrderResource($order),
                    'message' => 'Order created successfully'
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
    public function update(OrderRequest $request, $order_uuid)
    {
        try {
            $this->orderRepository->updateOrderDetails($request->all(), $order_uuid);
            return response(
                [
                    [],
                    'message' => 'Order details updated successfully'
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
    public function destroy($order_uuid)
    {
        try {
            $this->orderRepository->deleteOrder($order_uuid);

            return response(
                [
                    [],
                    'message' => 'Order deleted successfully'
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

    public function downloadOrder($uuid)
    {
        try {
            $order_file = $this->orderRepository->downloadOrder($uuid);

            return response(
                [
                    'order_file' => $order_file,
                    'message' => 'Order downloaded successfully'
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

    public function dashboardOrderDetails()
    {
        try {
            $dashboard_details = $this->orderRepository->dashboardOrderDetails();

            return response(
                [
                    'dashboard_details' => $dashboard_details,
                    'message' => 'Order details retrieved successfully'
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

    public function shipmentLocators()
    {
        try {
            $shipment_locators = $this->orderRepository->getShimentLocators();

            return response(
                [
                    'shipment_locators' => $shipment_locators,
                    'message' => 'shipment locators retrieved successfully'
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
