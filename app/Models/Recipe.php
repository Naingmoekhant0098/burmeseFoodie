<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable=['title','slug','people_id','rating','category_id','cuisine_id','description','nutrition','prepare_time','total_time','cooking_time','servings','steps','cost'];
    public function images(){
        return $this->hasMany(Media::class,'parent_id','id')->where('parent_type' , 'App\\Models\\Recipe');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }
    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }
}

