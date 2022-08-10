<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guards=[];
    protected $fillable=[
        'name',
        'price',
        'image',
        'slug' ,
        'description',
        'status',
        'category_id'

    ];
    public function categories(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function scopeSearch($query){
        if($key = request()->key){
            $query= $query->where('name', 'like','%' .$key. '%');
        }
        return $query;
}
}