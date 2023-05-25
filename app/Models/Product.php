<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'name',
        'description',
        'amount',
        'price',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function isCategorySelected(int $category_id): bool
    {
        return $this->hasCategory() && $this->category->id == $category_id;
    }

    public function hasCategory(): bool
    {
        return !is_null($this->category);
    }
}
