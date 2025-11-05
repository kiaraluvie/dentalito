<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantProfileController extends Controller
{
    /**
     * Display the tenant associated with the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/tenant-profile",
     *     summary="Get the profile of the tenant associated with the API key",
     *     tags={"Tenant"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Tenant")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tenant not found"
     *     )
     * )
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // Eager load the tenant relationship
        $user->load('tenant');

        $tenant = $user->tenant;

        if (!$tenant) {
            return response()->json(['message' => 'No tenant associated with this API key.'], 404);
        }

        return response()->json($tenant);
    }
}
