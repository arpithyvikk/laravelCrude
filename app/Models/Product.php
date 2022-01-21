<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $table ="products";

    protected $primarykey = "id";

    public function Category() 
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')->withTrashed();
    }
}
