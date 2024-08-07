<x-general-layout class="Products">
    <section class="Details">
        <section class="details_wrapper">
            <div class="container">
                <div class="images">
                    <div class="main_image">
                        <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}">
                    </div>
    
                    <div class="other_images">
                        @foreach($product->images as $image)
                            <img src="{{ asset('/storage/product_images/' . $image->image) }}" alt="{{ $product->title }}" width="200" height="200">
                        @endforeach
                    </div>
                </div>
    
                <div class="text">
                    <h1>{{ $product->title }}</h1>
    
                    <p class="price">
                        @if($discount = $product->calculated_price())
                            @if($discount['discount_percentage'] > 0)
                                <span class="price">
                                    <span class="new_price">Ksh. {{ $discount['new_price'] }}</span>
                                    <span class="old_price">{{ $product->selling_price }}</span>
                                </span>
                            @else
                                <span class="price">
                                    <span class="new_price">Ksh. {{ $product->selling_price }}</span>
                                </span>
                            @endif
                        @endif
                    </p>
    
                    <div class="forms">
                        @if($product->stock_count > 0)
                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                @csrf
            
                                <button type="submit">
                                    <i class="fas fa-cart-plus"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        @else
                            <span class="danger bold">Out of Stock</span>
                        @endif
    
                        @if(auth()->user() && !auth()->user()->has_reviewed_product($product->id))
                            <a href="{{ route('product-reviews.create', $product->slug) }}" class="btn">Review Product</a>
                        @endif
                    </div>
    
                    <div class="extras">
                        <p>
                            <span>Rating</span>
                            <span><i class="fas fa-star"></i> {{ $product->average_rating() > 0 ? number_format($product->average_rating(), 1) . ' / 5' : '0 / 5' }}</span>
                        </p>
                        <p>
                            <span>Stock</span>
                            <span class="bold {{ $product->stock_count == 0 ? 'danger' : 'success' }}">{{ $product->stock_count == 0 ? 'out of stock' : 'in stock' }}</span>
                        </p>
                        <p>
                            <span>Category</span>
                            <span>{{ $product->category ? $product->category->title : 'no category' }}</span>
                        </p>
                        <p>
                            <span>Product Code</span>
                            <span>{{ $product->product_code ? $product->product_code : 'product code is unknown' }}</span>
                        </p>
                    </div>
    
                    <div class="description">
                        {!! Illuminate\Support\Str::limit($product->description, 650) !!}
                    </div>
                </div>
            </div>
        </section>
    
        @if(count($product->visible_reviews()) > 0)
        <section class="reviews">
            <div class="container">
                <h2>Reviews</h2>
                <div class="reviews_wrapper">
                    @foreach($product->visible_reviews() as $review)
                        <p class="review">
                            <span class="rating"><i class="fas fa-star"></i> {{ $review->rating }} / 5</span>
                            <span class="content">{{ $review->review }}</span>
                            <span class="username">{{ $review->user->first_name . ' ' . $review->user->last_name }}</span>
                        </p>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    
        @if(count($related_products) > 0)
        <section class="related_products">
            <div class="container">
                <h2>Related Products</h2>
                <div class="cards">
                    @foreach($related_products as $product)
                        @include('product.card')
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </section>

    <x-slot name="javascript">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const mainProductImage = document.querySelector(".images .main_image img");
                const otherImagesContainer = document.querySelector(".other_images");
            
                otherImagesContainer.querySelectorAll("img").forEach((thumbnail) => {
                    thumbnail.addEventListener("click", (event) => {
                        // Remove active class from all thumbnails
                        otherImagesContainer.querySelectorAll("img").forEach((img) => {
                            img.classList.remove("active");
                        });
            
                        // Add active class to the clicked thumbnail
                        event.target.classList.add("active");
            
                        // Change the source of the main product image with a zoom effect
                        mainProductImage.src = event.target.src;
                    });
                });
            
                // Add the zoom effect on hover for the main product image
                mainProductImage.addEventListener("mousemove", (e) => {
                    const containerWidth = mainProductImage.offsetWidth;
                    const containerHeight = mainProductImage.offsetHeight;
            
                    const image = mainProductImage;
                    const imageWidth = image.offsetWidth;
                    const imageHeight = image.offsetHeight;
            
                    const x = e.pageX - mainProductImage.offsetLeft;
                    const y = e.pageY - mainProductImage.offsetTop;
            
                    const translateX = (containerWidth / 2 - x) * 2;
                    const translateY = (containerHeight / 2 - y) * 2;
            
                    const scale = 3;
            
                    image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
                });
            
                mainProductImage.addEventListener("mouseleave", () => {
                    mainProductImage.style.transform = "translate(0%, 0%) scale(1)";
                });
            });
        </script>
    </x-slot>
</x-general-layout>