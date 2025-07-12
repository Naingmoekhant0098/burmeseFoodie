<?php

namespace App\Http\Services;

use App\Models\Recipe;
use PhpParser\Node\Stmt\TryCatch;
use Storage;
use Illuminate\Support\Str;
// Removed incorrect import of now() as Laravel provides a global helper function for this.

class RecipesService
{
  

    public function popularRecipes($recipe){
        $response=[];
        try {
            $recipes = Recipe::with(['images', 'category', 'cuisine','ingredients'])->where('rating','>=',4)->limit(10)->get();
            
            $response['message'] = "Recipes Fetched Successfully";
            $response['status'] = true;
            $response['statusCode'] = 200;
            $response['data'] = $recipes;
        } catch (\Exception $e) {
            $response['message'] = $e;
            $response['status'] = false;
            $response['statusCode'] = 500;
        }


        return $response;
    }
    public function fetchRecipes($request)
    {
        $response = [];
        try {
            $currentPage = $request->get('currentPage', 1);
            $sortBy=$request->get('orderBy','created_at');
            $perPage = $request->get('perPage', 10);
            $offset = ($currentPage - 1) * $perPage;
            $sortOrder = $request->get('direction', 'desc');
            $recipes = Recipe::with(['images', 'category', 'cuisine','ingredients'])
            ->when($request->filled('recipeId'), function ($query) use ($request) {
                return $query->where('id', $request->get('recipeId'));
            })
            ->when($request->filled('categoryId'), function ($query) use ($request) {
                return $query->where('category_id', $request->get('categoryId'));
            })
            ->when($request->filled('cuisineId'), function ($query) use ($request) {
                return $query->where('cuisine_id', $request->get('cuisineId'));
            })
            ->orderBy($sortBy, $sortOrder)
            ->offset($offset)
            ->limit($perPage)
            ->get();
            $response['message'] = "Recipes Fetched Successfully";
            $response['status'] = true;
            $response['statusCode'] = 200;
            $response['data'] = $recipes;
        } catch (\Exception $e) {
            $response['message'] = $e;
            $response['status'] = false;
            $response['statusCode'] = 500;
        }


        return $response;
    }
    public function storeRecipes($data)
    {
        $response = [];
        try{
            $slug = Str::slug($data->title, '-');
            $data->merge(['slug' => $slug]);
            $recipe = Recipe::create($data->except('image'));
            $ingredients = json_decode($data->ingredients, true);
            $recipe->ingredients()->attach($ingredients); 
            if ($data->hasFile('image')) {
                $image = $data->file('image');
                $extension = $image->getClientOriginalExtension();
                $fileName = now()->format('YmdHis').".".$extension;
                $fileSize = $image->getSize();
                $fileType = $image->getClientMimeType();
                $filePath = "uploads/images/{$fileName}";
                Storage::disk('public')->put($filePath, file_get_contents($image));
                $recipe->images()->create([
                    'parent_id' => $recipe->id,
                    'parent_type' => 'App\Models\Recipe',
                    "image_type" => $fileType,
                    "path" => "/storage/{$filePath}",
                    'size' => $fileSize
                ]);
            }
            $response['message'] = "Recipes Created Successfully";
            $response['status'] = true;
            $response['statusCode'] = 201;
            $response['data'] = $recipe;           
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = false;
            $response['statusCode'] = 500;
        }
        return $response;
    }

    public function fetchSingleRecipe($id){
        $response=[];
        try {
            $cuisine = Recipe::with(['images', 'category', 'cuisine','ingredients'])->findOrFail($id);
            $response['message'] = "Racipe Get Successfully";
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