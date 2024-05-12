<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function getImageUrl()
    {
        if($this->image) {
            return asset($this->image);
        } else {
            return asset('assets/images/default_image.jpg');
        }
    }
}
