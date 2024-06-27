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
        'is_published',
        'ordering',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function getImageUrl()
    {
        if($this->image) {
            return asset('storage/blog_images/' . $this->image);
        } else {
            return asset('assets/images/default_image.jpg');
        }
    }
}
