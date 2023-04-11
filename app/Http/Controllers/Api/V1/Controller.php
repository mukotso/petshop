<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Buckhill Petshop Api Documentation",
 *     description="Buckhill Petshop Api Documentation",
 *     @OA\Contact(
 *         name="Kelvin Mukotso",
 *         email="kelvinmukotso@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * ),
 * @OA\Server(
 *     url="/api/v1",
 * ),
 */
class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;
}
