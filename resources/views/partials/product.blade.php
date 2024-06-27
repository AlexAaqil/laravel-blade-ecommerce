<div class="card product_card">
    <div class="image">
        <a href="#">
            <img src="{{ asset('assets/images/hero.png') }}" alt="Product Title">
        </a>

        <span class="percentage_discount">50% off</span>

        <div class="actions">
            <div class="action">
                <form action="" method="POST">
                    @csrf

                    <button type="submit">
                        {{-- Add to cart --}}
                        <i class="fa fa-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="details">
        <div class="extra_details">
            <span>
                <a href="#">category</a>
            </span>
        </div>
        
        <div class="content">
            <div class="info">
                <div class="title">
                    <a href="#">Title</a>
                </div>

                <div class="price_rating">
                    <span class="price">
                        <span class="new_price">Ksh. 1000</span>
                        <span class="old_price"><del>1200</del></span>
                    </span>

                    <span class="rating">
                        <span><i class="fas fa-star"></i> 4.5 (25 reviews)</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>