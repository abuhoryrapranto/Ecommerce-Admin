<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function subType() {
        return $this->belongsTo(SubType::class);
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class);
    }

    public function productOptions() {
        return $this->hasOne(ProductOption::class);
    }
}
