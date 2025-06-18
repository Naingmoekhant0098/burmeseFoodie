<?php
namespace App\Http\Services;

use App\Models\Category;
use Storage;
class CategoryService
{
    public function fetchCategories()
    { {
            $response = [];
            try {
                $categories = Category::with('image')->get();
                $response['message'] = "Catgories Fetched Successfully";
                $response['status'] = true;
                $response['statusCode'] = 200;
                $response['data'] = $categories;
            } catch (\Exception $e) {
                $response['message'] = $e;
                $response['status'] = false;
                $response['status'] = 500;
            }


            return $response;
        }
    }

    public function storeCategory($data)
    {
        $response = [];
        try {
            $category = Category::create($data->except('image'));
            if ($data->hasFile('image')) {
                $image = $data->file('image');
                $extension = $image->getClientOriginalExtension();
                $fileName = now()->format('YmdHis') . "." . $extension;
                $fileSize = $image->getSize();
                $fileType = $image->getClientMimeType();
                $filePath = "uploads/images/{$fileName}";
                Storage::disk('public')->put($filePath, $image);
                $category->image()->create([
                    'parent_id' => $category->id,
                    'parent_type' => 'App\Models\Category',
                    "image_type" => $fileType,
                    "path" => '/storage/' . $filePath,
                    'size' => $fileSize
                ]);
            }
            $response['message'] = "Category Created Successfully";
            $response['status'] = true;
            $response['statusCode'] = 201;
            $response['data'] = $category;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = false;
            $response['status'] = 500;
        }
        return $response;


    }

    public function fetchSingleCategory($id){
        $response=[];
        try {
            $cuisine = Category::with('image')->find($id);
            $response['message'] = "Category Get Successfully";
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