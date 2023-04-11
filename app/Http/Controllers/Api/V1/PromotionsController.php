<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\PromotionResource;
use App\Interfaces\V1\PromotionInterface;;
use Illuminate\Support\Facades\Log;

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
        try {
            $promotions = $this->promotionRepository->getAllPromotions();
            return response(
                [
                    'promotions' => PromotionResource::collection($promotions),
                    'message' => 'Promotions Retrieved successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
