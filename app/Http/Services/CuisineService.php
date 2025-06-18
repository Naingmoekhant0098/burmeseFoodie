<?php
namespace App\Http\Services;

use App\Models\Cuisine;
use PhpParser\Node\Stmt\TryCatch;
class CuisineService{
    public function fetchCuisines(){
        {
            $response = [];
            try {
                $cuisines = Cuisine::get();
                $response['message'] = "Cuisines Fetched Successfully";
                $response['status'] = true;
                $response['statusCode'] = 200;
                $response['data'] = $cuisines;
            } catch (\Exception $e) {
                $response['message'] = $e;
                $response['status'] = false;
                $response['status'] = 500;
            }
    
    
            return $response;
        }
    }

    public function storeCuisine($data){
        $response=[];
        try {
            $cuisines = Cuisine::create([
                'name'=>$data['name']
            ]);
            $response['message'] = "Cuisines Created Successfully";
            $response['status'] = true;
            $response['statusCode'] = 201;
            $response['data'] = $cuisines;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = false;
            $response['status'] = 500;
        }
        return $response;
    }

    public function fetchSingleCuisine($id){
        $response=[];
        try {
            $cuisine = Cuisine::find($id);
            $response['message'] = "Cuisines Get Successfully";
            $response['status'] = true;
            $response['statusCode'] = 200;
            $response['data'] = $cuisine;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = false;
            $response['status'] = 500;
        }
        return $response;
    }
}


?>