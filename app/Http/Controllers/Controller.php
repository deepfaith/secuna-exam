<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="API Documentation - Secuna Exam Laravel",
 *     version="1.0.0",
 *     title="Secuna Exam API Documentation",
 *     @OA\Contact(
 *         email="alan.ontue@gmail.com"
 *     ),
 *     @OA\License(
 *         name="GPL2",
 *         url="https://github.com/deepfaith?tab=repositories"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
