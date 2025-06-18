<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable =['name'];
    public function image(){
        return $this->hasOne(Media::class,'parent_id','id')->where('parent_type' , 'App\\Models\\Category');
    }
}
