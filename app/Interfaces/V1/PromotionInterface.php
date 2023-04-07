<?php

namespace App\Interfaces\V1;


interface PromotionInterface
{

    public function getAllPromotions();

    public function showPromotionDetails($promotion_uuid);


}
