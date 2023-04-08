<?php

namespace App\Http\Controllers\Api\V1;

use App\Interfaces\V1\PromotionInterface;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{

    protected PromotionInterface $promotionRepository;

    public function __construct(PromotionInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->promotionRepository->getAllPromotions();
    }

}
