<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'product_code',
        'category_id',
        'featured',
        'stock_count',
        'safety_stock',
        'buying_price',
        'selling_price',
        'discount_price',
        'product_measurement',
        'measurement_id',
        'product_order',
        'description'
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function measurement_unit()
    {
        return $this->belongsTo(ProductMeasurement::class, 'measurement_id');
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }


    public function getProductImages() {
        return $this->hasMany(ProductImages::class, 'product_id')->orderBy('image_order', 'asc');
    }

    public function getTranslatedInStock()
    {
        return $this->in_stock == 1 ? 'Yes' : 'No';
    }

    public function getTranslatedFeatured()
    {
        return $this->featured == 1 ? 'Yes' : 'No';
    }

    public function getFirstImage() {
        $productImages = $this->getProductImages()->get();
        
        if ($productImages->isEmpty()) {
            return asset('assets/images/default_image.jpg');
        }
    
        $firstImage = $productImages->first();
    
        if (!$firstImage || !$firstImage->image) {
            return asset('assets/images/default_image.jpg');
        }
    
        $imagePath = $firstImage->image;
    
        // Check if the image exists in storage, otherwise return the default image path
        if (Storage::disk('public')->exists($imagePath)) {
            return Storage::url($imagePath);
        } else {
            return asset('assets/images/default_image.jpg');
        }
    }    

    public function calculateDiscount()
    {
        if ($this->discount_price != 0 && $this->discount_price < $this->selling_price) {
            // Calculate the discount percentage
            $discountPercentage = (($this->selling_price - $this->discount_price) / $this->selling_price) * 100;

            // Set the new price and percentage in the model
            $this->new_price = $this->discount_price;
            $this->discount_percentage = round($discountPercentage, 0);
        } else {
            // If no discount, set the new price as the regular price
            $this->new_price = $this->selling_price;
            $this->discount_percentage = 0;
        }

        return $this->discount_percentage;
    }
}
