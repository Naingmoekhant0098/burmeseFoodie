<?php

namespace App\Http\Controllers;

use App\Http\Resources\cuisineResource;
use App\Http\Response\ApiResponse;
use App\Http\Services\CuisineService;
use Illuminate\Http\Request;

class cuisineController extends Controller
{
    protected $cuisineService;
    protected $apiResponse;
    public function __construct(CuisineService $cuisineService, ApiResponse $apiResponse)
    {
        $this->cuisineService = $cuisineService;
        $this->apiResponse = $apiResponse;
    }
    public function index()
    {
        $response = $this->cuisineService->fetchCuisines();
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = cuisineResource::collection($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }



    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    
    {
        $response = $this->cuisineService->storeCuisine($request);
        if ($response['statusCode'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {
            $data = new cuisineResource($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->cuisineService->fetchSingleCuisine($id);
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data =new cuisineResource($response['data']);
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

        return $request;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
