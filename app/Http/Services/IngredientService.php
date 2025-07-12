<?php
namespace App\Http\Services;

use App\Models\Ingredient;
use Storage;
class IngredientService
{
    public function fetchIngredient()
    { 
            $response = [];
            try {
                $ingredients = Ingredient::with('image')->get();
                $response['message'] = "Ingredients Fetched Successfully";
                $response['status'] = true;
                $response['statusCode'] = 200;
                $response['data'] = $ingredients;
            } catch (\Exception $e) {
                $response['message'] = $e;
                $response['status'] = false;
                $response['status'] = 500;
            }


            return $response;
        
    }
    public function storeIngredient($data)
    {
        $response = [];
        try {
            $ingredient = Ingredient::create($data->except('image'));
            if ($data->hasFile('image')) {
                $image = $data->file('image');
                $extension = $image->getClientOriginalExtension();
                $fileName = now()->format('YmdHis') . "." . $extension;
                $fileSize = $image->getSize();
                $fileType = $image->getClientMimeType();
                $filePath = "uploads/images/{$fileName}";
                Storage::disk('public')->put($filePath, file_get_contents($image));
                $ingredient->image()->create([
                    'parent_id' => $ingredient->id,
                    'parent_type' => 'App\Models\Ingredient',
                    "image_type" => $fileType,
                    "path" => '/storage/' . $filePath,
                    'size' => $fileSize
                ]);
            }
            $response['message'] = "Ingredient Created Successfully";
            $response['status'] = true;
            $response['statusCode'] = 201;
            $response['data'] = $ingredient;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = false;
            $response['status'] = 500;
        }


        return $response;

    }
}


?>