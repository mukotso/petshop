<?php

namespace App\Repositories\V1;


use App\Http\Resources\V1\PromotionResource;
use App\Interfaces\V1\PromotionInterface;
use App\Models\Promotion;


class PromotionRepository implements PromotionInterface
{

    public function getAllPromotions()
    {
        return Promotion::all()->orderBy('created_at', 'DESC')->paginate('8');
    }


}
