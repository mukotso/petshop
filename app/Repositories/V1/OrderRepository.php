<?php

namespace App\Repositories\V1;


use App\Interfaces\V1\OrderInterface;
use App\Models\Order;


class OrderRepository implements OrderInterface
{

    public function getAllOrders()
    {
        return Order::with('user','orderStatus','payment')->orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createOrder(array $order_details)
    {
        return Order::create($order_details);
    }

    public function showOrderDetails($order_uuid)
    {
        return Order::with('user','orderStatus','payment')->findorFail($order_uuid);
    }

    public function updateOrderDetails(array $order_details, $order_uuid){
        $order = Order::findorFail($order_uuid);
        return $order->update($order_details);
    }

    public function getUserOrders($user_uuid)
    {
        return Order::where('user_uuid',$user_uuid)->with('user','orderStatus','payment')->get();
    }

    public function getShimentLocators(){
        return Order::shipped()->with('user','orderStatus','payment')->orderBy('created_at', 'DESC')->paginate('8');

    }

    public function downloadOrder($uuid){

    }

    public function dashboardOrderDetails(){
        return Order::with('user','orderStatus','payment')->orderBy('created_at', 'DESC')->paginate('8');

    }

}
