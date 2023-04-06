<?php

namespace App\Interfaces;


interface OrderInterface
{

    public function getAllOrders();

    public function createOrder($order_details);

    public function getUserOrders($user_uuid);

   


}