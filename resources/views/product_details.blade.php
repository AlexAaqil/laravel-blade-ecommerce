<x-app-layout>
@include('partials.navbar')
<main class="Product_details">
    @include('partials.messages')
    <div class="container">
        <div class="wrapper">
            <div class="images">
                <div class="main_product_image">
                    <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}" >
                </div>
                <div class="other_images">
                    @foreach($product_images as $image)
                        <img src={{ $image->getProductImageURL() }} alt="Other Image">
                    @endforeach
                </div>
            </div>

            <div class="details">
                <h1>{{ $product->title }}</h1>
                <p class="price">
                    @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
                        <span class="price">
                            <span class="amount">Ksh. {{ $product->discount_price }}</span>
                            <span class="discount_price">
                                <del>{{ $product->selling_price }}</del>
                            </span>
                            <span class="discount_percentage">
                                {{ round($product->calculateDiscount()) }}% off
                            </span>
                        </span>
                    @else
                        <span class="price">
                            <span class="currency">Ksh.</span>
                            <span class="price_amount">{{ $product->selling_price }}</span>
                        </span>
                    @endif
                </p>

                <div class="action">
                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-cart-plus add_to_cart_btn"></i> Add to Cart
                        </button>
                    </form>

                    @if(auth()->user() && !auth()->user()->hasReviewedProduct($product->id))
                        <a href="{{ route('product-reviews.create', $product->slug) }}">Review Product</a>
                    @endif
                </div>

                <div class="extras">
                    @if($product->product_reviews->isNotEmpty())
                        <p>
                            <span>Rating</span>
                            <span><i class="fas fa-star"></i> {{ number_format($product->product_reviews->avg('rating'), 1) }} / 5</span>
                        </p>
                    @endif

                    @if($product->product_measurement && $product->measurement_id)
                        <p>
                            <span>Size</span>
                            <span>{{ $product->product_measurement . ' ' . $product->measurement_unit->measurement_name }}</span>
                        </p>
                    @endif

                    @if($product->category_id != null)
                        <p>
                            <span>Category</span>
                            <span>
                                <a href="{{ route('products.categorized', $product->product_category->slug) }}">
                                    {{ $product->product_category->title }}
                                </a>
                            </span>
                        </p>
                    @endif
                </div>

                <div class="description">
                    {!! Illuminate\Support\Str::limit($product->description, 650) !!}
                </div>
            </div>
        </div>
    </div>

    @if($product->product_reviews->isNotEmpty())
        <div class="product_reviews">
            <div class="container">
                <h1>Reviews</h1>
                <div class="reviews_wrapper">
                    @foreach($product->product_reviews as $product_review)
                        <div class="review">
                            <p>{{ $product_review->review }}</p>
                            <p class="details">
                                <span class="username">{{ $product_review->user->first_name . ' ' . $product_review->user->last_name  }}</span>
                                <span class="date">{{ $product_review->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($related_products->count() > 0)
    <div class="container related_products">
        <h1>Related Products</h2>
        <div class="card_wrapper products_wrapper">
            @foreach($related_products as $product)
                @include('partials.product')
            @endforeach
        </div>
    </div>
    @endif
</main>

<x-slot name="javascript">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainProductImage = document.querySelector(".main_product_image img");
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
</x-app-layout>
