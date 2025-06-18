<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\categoryResource;
use App\Http\Response\ApiResponse;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class categoryController extends Controller
{

    protected $categoryService;
    protected $apiResponse;
    public function __construct(CategoryService $categoryService, ApiResponse $apiResponse)
    {
        $this->categoryService = $categoryService;
        $this->apiResponse = $apiResponse;
    }
    public function index()
    {
        $response = $this->categoryService->fetchCategories();
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = categoryResource::collection($response['data']);
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
    public function store(CategoryRequest $request)
    {

        $response = $this->categoryService->storeCategory($request);
        if ($response['statusCode'] == false) {

            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = new categoryResource($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->categoryService->fetchSingleCategory($id);
        if ($response['status'] == false) {
            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = new categoryResource($response['data']);
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
