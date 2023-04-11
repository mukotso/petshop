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

    /**
     * @OA\Get(
     * path="/main/promotions",
     * summary="List all promotions",
     * description=" view all promotions",
     * tags={"Main Page"},
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
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
