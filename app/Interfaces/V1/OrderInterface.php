<?php

namespace App\Interfaces\V1;


interface OrderInterface
{

    public function getAllOrders();

    public function createOrder(array $order_details);

    public function getUserOrders($user_uuid);


}
