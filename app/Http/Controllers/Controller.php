<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Blog Main Base API Documentation",
 *      description="API documentation for the project"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Enter token in format (Bearer <token>)",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     securityScheme="sanctum",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}