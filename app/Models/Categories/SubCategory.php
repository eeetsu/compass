<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        return $this->belongsTo(MainCategory::class);
    }

    public static function getSubCategories(){
        return self::all();
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public static function getSubCategoriesByMainCategoryId($mainCategoryId){
        return self::where('main_category_id', $mainCategoryId)->get();
    }
}
