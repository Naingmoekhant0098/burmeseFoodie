<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipesRequest;
use App\Http\Resources\recipesResource;
use App\Http\Services\RecipesService;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;

class recipesController extends Controller
{
    protected $recipesService;
    protected $apiResponse;
    public function __construct(RecipesService $recipesService, ApiResponse $apiResponse)
    {
        $this->recipesService = $recipesService;
        $this->apiResponse = $apiResponse;
    }
    public function index()
    {
        $response = $this->recipesService->fetchRecipes();
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = recipesResource::collection($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipesRequest $request)
    {


        $response = $this->recipesService->storeRecipes($request);

        if ($response['statusCode'] == false) {

            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = new recipesResource($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $response = $this->recipesService->fetchSingleRecipe($id);
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = new recipesResource($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
