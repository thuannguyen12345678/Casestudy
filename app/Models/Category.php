<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public function product(){
        return $this->hasMany(Product::class, 'category_id','id');
    }

    public function scopeSearch($query){
        if($key = request()->key){
            $query= $query->where('LOAIGIAY', 'like','%' .$key. '%');
        }
        return $query;
}
}
