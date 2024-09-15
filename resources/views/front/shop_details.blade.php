@extends('layouts.front_layout.front_layout')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar for categories or filters -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>

        <!-- Product Listings -->
        <div class="col-md-9">
            <div class="row">
                
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <!-- Product Image -->
                        <img class="card-img-top" src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}" style="height: 225px; width: 100%; display: block;">

                        <div class="card-body">
                            <!-- Product Name -->
                            <h5 class="card-title">{{ $product->name }}</h5>
                            
                            <!-- Product Price -->
                            <p class="card-text">${{ number_format($product->price, 2) }}</p>
                            
                            <!-- Add to Cart Button -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <div class="product__item__text">
                                        <h6>{{ $product->product_name }}</h6>
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 80px;">
                                            <button type="submit" class="btn btn-primary add-cart">+ Add To Cart</button>
                                        </form>                                    
                                        <div class="rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $product->rating)
                                                    <i class="fa fa-star"></i>
                                                @else
                                                    <i class="fa fa-star-o"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h5>${{ $product->product_price }}</h5>
                                    </div>                        
                                 </div>
                                <small class="text-muted">{{ $product->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{-- {{ $products->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
    </div>
    
</div>

{{-- other code --}}
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}" >
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}" >
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}" >
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{  asset('videos/product_videos/' . $product->product_video) }}" alt="{{ $product->name }}" >
                                    <i class="fa fa-play"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="{{ $product->name }}" >
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ asset('front_images/shop-details/product-big-4.png')}}" alt="">
                                <a href="{{ asset('videos/product_videos/' . $product->product_video) }}" alt="{{ $product->name }}" class="video-popup"><i class="fa fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $product->product_name }}</h4>
                        <div class="rating">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $product->rating)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        <h5></h5>
                        <h3>${{ $product->product_price }}<span>${{ $product->product_discount }}</span></h3>
                        <p>{{ $product->description }}</p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                <form action="{{ route('fetch.sku') }}" method="GET" id="size-form">
                                    @foreach($sizes as $size)
                                        <label for="size-{{ $size->id }}">
                                            {{ $size->size }} <!-- Display the size value here -->
                                            <input type="radio" id="size-{{ $size->id }}" name="size" value="{{ $size->size }}" onchange="document.getElementById('size-form').submit();">
                                        </label>
                                    @endforeach
                                </form>
                                
                            </div>
                            
                            @php
                            use Illuminate\Support\Str;
                        @endphp
                        
                        <div class="product__details__option__color">
                            <span>Color:</span>
                            @foreach($colors as $color)
                                @php
                                    // Generate a unique id for each color using Str::slug
                                    $id = 'color-' . Str::slug($color, '-') . '-' . uniqid();
                                @endphp
                                <label class="c-{{ $loop->index + 1 }}" for="{{ $id }}" style="background-color: {{ $color }}">
                                    <input type="radio" id="{{ $id }}" name="color" value="{{ $color }}">
                                </label>
                            @endforeach
                        </div>
                        
                            
                        </div>
                        <div class="product__details__cart__option">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="quantity">
                                    <div class="pro-qty"><span class="fa fa-angle-up dec qtybtn"></span>
                                        <input type="number" name="quantity" value="1" min="1" >
                                    <span class="fa fa-angle-down inc qtybtn"></span></div>
                                </div>
                                {{-- <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 80px;"> --}}
                                <button type="submit" class="primary-btn add-cart">Add To Cart</button>
                            </form>    
                        </div>
                        {{-- <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div> --}}
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="{{asset('front_images/shop-details/details-payment.png')}}" alt="">
                            <ul>
                                <li><span>SKU:</span> <span id="sku">Select a size</span></li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                                                       
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                Previews(5)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                    pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                    pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                        a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                        $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                        worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('input[name="size"]').forEach(function(sizeRadio) {
        sizeRadio.addEventListener('change', function() {
            let selectedSize = this.value;

            fetch(`/front/fetch-sku?size=${selectedSize}`)
                .then(response => response.json()) // Ensure this is correctly parsed
                .then(data => {
                    // Update the SKU display in the view
                    document.getElementById('sku').textContent = data.sku;
                })
                .catch(error => {
                    console.error('Error fetching SKU:', error);
                });
        });
    });
</script>


@endsection
