<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LanguageResource;

/**
 * @OA\Tag(
 *     name="Languages",
 *     description="API Endpoints for Languages"
 * )
 */
class LanguageController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/languages",
     *      operationId="getLanguagesList",
     *      tags={"Languages"},
     *      summary="Get list of languages",
     *      description="Returns list of languages",
     *      security={{"sanctum": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Language"))
     *       ),
     *      @OA\Response(response=401, description="Unauthenticated"),
     * )
     */
    public function index()
    {
        return LanguageResource::collection(Language::paginate(10));
    }

    /**
     * @OA\Post(
     *      path="/api/languages",
     *      operationId="storeLanguage",
     *      tags={"Languages"},
     *      summary="Store new language",
     *      description="Returns language data",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Language")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Language")
     *       ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'iso_code' => 'required|string|max:10|unique:languages',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = auth()->id();
        $validatedData['is_active'] = 1; // Force new languages to be active

        $language = Language::create($validatedData);

        return new LanguageResource($language);
    }

    /**
     * @OA\Get(
     *      path="/api/languages/{id}",
     *      operationId="getLanguageById",
     *      tags={"Languages"},
     *      summary="Get language information",
     *      description="Returns language data",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Language id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Language")
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show($id)
    {
        $language = Language::findOrFail($id);
        return new LanguageResource($language);
    }

    /**
     * @OA\Put(
     *      path="/api/languages/{id}",
     *      operationId="updateLanguage",
     *      tags={"Languages"},
     *      summary="Update existing language",
     *      description="Returns updated language data",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Language id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Language")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Language")
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'iso_code' => 'sometimes|required|string|max:10|unique:languages,iso_code,' . $language->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $language->update($validator->validated());

        return new LanguageResource($language);
    }

    /**
     * @OA\Delete(
     *      path="/api/languages/{id}",
     *      operationId="deleteLanguage",
     *      tags={"Languages"},
     *      summary="Delete existing language",
     *      description="Deletes a record and returns no content",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Language id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=204, description="Successful operation"),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->is_active = 0;
        $language->save();
        $language->delete();

        return response()->json(null, 204);
    }
}