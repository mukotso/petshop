<?php

namespace App\Interfaces\V1;


interface OrderStatusInterface
{

    public function getAllOrderStatuses();

    public function createOrderStatus(array $order_status_details);

    public function showOrderStatusDetails($order_status_uuid);

    public function updateOrderStatusDetails($order_status_uuid);

    public function deleteOrderStatus($order_status_uuid);


}
