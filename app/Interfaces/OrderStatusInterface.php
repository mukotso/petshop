<?php

namespace App\Interfaces;


interface OrderStatusInterface
{

    public function getAllOrderStatuses();

    public function createOrderStatus($order_status_details);

    public function showOrderStatusDetails($order_status_uuid);

    public function updateOrderStatusDetails($order_status_uuid);

    public function deleteOrderStatus($order_status_uuid);
   

}