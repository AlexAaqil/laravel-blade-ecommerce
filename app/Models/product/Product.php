<?php

namespace App\Models\product;

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
        'is_featured',
        'is_visible',
        'buying_price',
        'selling_price',
        'discount_amount',
        'discount_percentage',
        'stock_count',
        'safety_stock',
        'ordering',
        'description',
        'measurement_id',
        'category_id',
    ];

    public function calculate_discount()
    {
        $discountAmount = $this->discount_amount;
        $discountPercentage = $this->discount_percentage;
        $sellingPrice = $this->selling_price;
    
        if ($discountAmount && $discountAmount < $sellingPrice) {
            // Calculate the discount percentage based on the discount amount
            $discountPercentage = ($discountAmount / $sellingPrice) * 100;
            $this->new_price = $sellingPrice - $discountAmount;
            $this->discount_percentage = round($discountPercentage, 0);
        } elseif ($discountPercentage && $discountPercentage < 100) {
            // Calculate the discount amount based on the discount percentage
            $discountAmount = ($discountPercentage / 100) * $sellingPrice;
            $this->new_price = $sellingPrice - $discountAmount;
            $this->discount_amount = $discountAmount;
        } else {
            // If no discount, set the new price as the regular price
            $this->new_price = $sellingPrice;
            $this->discount_percentage = 0;
            $this->discount_amount = 0;
        }
    
        return [
            'discount_amount' => $this->discount_amount,
            'discount_percentage' => $this->discount_percentage
        ];
    }    

    public function measurement()
    {
        return $this->belongsTo(ProductMeasurement::class, 'measurement_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function images() 
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('ordering');
    }

    public function getFirstImage() 
    {
        $productImages = $this->images()->get();
        
        if ($productImages->isEmpty()) {
            return asset('assets/images/default_image.jpg');
        }
    
        $firstImage = $productImages->first();
    
        if (!$firstImage || !$firstImage->image) {
            return asset('assets/images/default_image.jpg');
        }
    
        $imagePath = 'product_images/' . $firstImage->image;
    
        // Check if the image exists in storage, otherwise return the default image path
        if (Storage::disk('public')->exists($imagePath)) {
            return asset('storage/' . $imagePath);
        } else {
            return asset('assets/images/default_image.jpg');
        }
    } 

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function visible_reviews()
    {
        return $this->reviews->where('is_visible', 1);
    }

    public function average_rating()
    {
        return $this->visible_reviews()->avg('rating');
    }
}
