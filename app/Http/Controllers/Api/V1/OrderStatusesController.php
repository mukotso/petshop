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


    /**
     * @OA\Get(
     * path="/order-statuses",
     * summary="List all order status",
     * description="view all status",
     * tags={"Order Status"},
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
     * path="/order-status/create",
     * summary="Create order status",
     * description=" create a status",
     * tags={"Order Status"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required order status details",
     *    @OA\JsonContent(
     *       required={"title"},
     *       @OA\Property(property="title", type="string", example="pending"),
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
    public function create(OrderStatusesRequest $request)
    {
        try {
            $orderStatus = $this->orderStatusRepository->createOrderStatus($request->all());

            return response(
                [
                    'orderStatus' => new OrderStatusResource($orderStatus),
                    'message' => 'Order statuses added successfully'
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
     * path="/order-status/{order_status_uuid}",
     * summary="view a single status",
     * description="view a status",
     * tags={"Order Status"},
     * @OA\Parameter(
     *          name="order_status_uuid",
     *          description="status id",
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
    public function show($order_status_uuid)
    {
        try {
            $orderStatus = $this->orderStatusRepository->showOrderStatusDetails($order_status_uuid);

            return response(
                [
                    'orderStatus' => new OrderStatusResource($orderStatus),
                    'message' => 'order status fetched successfully'
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
     * path="/order-status/{order_status_uuid}",
     * summary="update order status",
     * description="update order status",
     * tags={"Order Status"},
     * @OA\Parameter(
     *          name="order_status_uuid",
     *          description="status id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass required order status details",
     *    @OA\JsonContent(
     *       required={"title"},
     *       @OA\Property(property="title", type="string", example="paid"),
     *    ),
     * ),
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
    public function update(OrderStatusesRequest $request,  $order_status_uuid)
    {
        try {
            $this->orderStatusRepository->updateOrderStatusDetails($request->all(), $order_status_uuid);
            return response(
                [
                    'message' => 'order status details updated successfully'
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
     * path="/order-status/{order_status_uuid}",
     * summary="delete order status",
     * description="delete order status",
     * tags={"Order Status"},
     * @OA\Parameter(
     *          name="order_status_uuid",
     *          description="status id",
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
    public function destroy( $order_status_uuid)
    {
        try {
            $this->orderStatusRepository->deleteOrderStatus($order_status_uuid);

            return response(
                [
                    'message' => 'order status deleted successfully'
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
