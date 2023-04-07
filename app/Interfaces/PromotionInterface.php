<?php

namespace App\Interfaces;


interface PromotionInterface
{

    public function getAllPromotions();

    public function showPromotionDetails($promotion_uuid);


}
