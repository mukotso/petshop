<?php

namespace App\Repositories\V1;


use App\Interfaces\V1\OrderStatusInterface;
use App\Models\Order;
use App\Models\OrderStatus;


class OrderStatusRepository implements OrderStatusInterface
{

    public function getAllOrderStatuses()
    {
        return OrderStatus::orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createOrderStatus(array $order_status_details)
    {
        return OrderStatus::create($order_status_details);
    }

    public function showOrderStatusDetails($order_status_uuid)
    {
        return OrderStatus::findorFail($order_status_uuid);
    }

    public function updateOrderStatusDetails(array $order_status_details , $order_status_uuid)
    {
        $order_status = OrderStatus::findorFail($order_status_uuid);
        $order_status->update($order_status_details);
        return $order_status;
    }

    public function deleteOrderStatus($order_status_uuid)
    {
        $order_status = OrderStatus::findorFail($order_status_uuid);
        return $order_status->delete();
    }


}
