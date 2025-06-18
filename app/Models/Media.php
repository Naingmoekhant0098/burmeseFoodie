<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable =['parent_id',"parent_type",'image_type','path','size'];
}
