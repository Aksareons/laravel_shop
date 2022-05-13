<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use FormAccessible, SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'dsc', 'price', 'barcode', 'stock', 'cover'
    ];
    use FormAccessible, SoftDeletes, HasFactory;

    public function categories (){
        return $this->belongsToMany(Category::class);
    }
    public function gallery(){
        return $this->hasOne(Gallery::class);
    }
}
