<?php

namespace App\Interfaces\V1;


interface OrderInterface
{

    public function getAllOrders();

    public function createOrder(array $order_details);

    public function showOrderDetails($order_uuid);
    public function updateOrderDetails(array $order_details, $order_uuid);

    public function getUserOrders($user_uuid);

    public function getShimentLocators();

    public function downloadOrder($uuid);

    public function dashboardOrderDetails();
}
