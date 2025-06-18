<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable =['name',"amount",'unit'];

    public function image(){
        return $this->hasOne(Media::class,'parent_id','id')->where('parent_type' , 'App\\Models\\Ingredient');
    }
    public function recipes(){
        return $this->belongsToMany(Recipe::class)->withPivot(['amount']);
    }
}
