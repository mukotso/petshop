<?php

namespace App\Interfaces;


interface PromotionInterface
{

    public function getAllPromotions();

    public function createPromotion($promotion_details);

    public function showPromotionDetails($promotion_uuid);

    public function updatePromotionDetails($promotion_uuid);

    public function deletePromotion($promotion_uuid);
   


}