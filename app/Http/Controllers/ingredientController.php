<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Http\Resources\ingredientResource;
use App\Http\Response\ApiResponse;
use App\Http\Services\IngredientService;
use Illuminate\Http\Request;

class ingredientController extends Controller
{
    protected $ingredientService;
    protected $apiResponse;
    public function __construct(IngredientService $ingredientService,ApiResponse $apiResponse){
       $this->ingredientService=$ingredientService;
       $this->apiResponse=$apiResponse;
    }
   public function index()
   {
      $response = $this->ingredientService->fetchIngredient();
      if($response['status']==false){
      return $this->apiResponse->errorResponse($response['message'],$response['statusCode']);
      }else{
       
       $data = ingredientResource::collection($response['data']);
       return $this->apiResponse->successResponse($data,$response['message'],$response['statusCode']);
       
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
    public function store(IngredientRequest $request)
    {
        $response = $this->ingredientService->storeIngredient($request);
        if ($response['statusCode'] == false) {

            return $this->apiResponse->errorResponse($response['message'], $response['statusCode']);
        } else {

            $data = new ingredientResource($response['data']);
            return $this->apiResponse->successResponse($data, $response['message'], $response['statusCode']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
