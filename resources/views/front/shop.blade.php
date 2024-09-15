@extends('layouts.front_layout.front_layout')

<style>
    .color-swatches {
        list-style: none;
        padding-left: 0;
    }

    .color-swatches li {
        display: inline-block;
        margin-right: 10px;
    }

    .color-swatch {
        width: 30px;
        height: 30px;
        display: inline-block;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .color-swatch:hover {
        transform: scale(1.1);
    }
    
    .filter-list li {
        margin-bottom: 10px;
    }

    .filter-item {
        color: #333;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        transition: background-color 0.3s, color 0.3s;
    }

    .filter-item:hover {
        background-color: #5a5a5a;
        color: #fff;
    }
</style>

@section('content')
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="{{ url('shop') }}" method="get">
                            <input type="text" name="search" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>

                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <!-- Filter by Categories -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseCategories">Categories</a>
                                </div>
                                <div id="collapseCategories" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul class="list-unstyled filter-list">
                                            @foreach ($categories as $category)
                                                <li><a href="{{ url()->current() }}?category_id={{ $category->id }}" class="filter-item">{{ $category->category_name }} ({{ $category->products_count }})</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter by Color with Swatches -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseColors">Filter by Color</a>
                                </div>
                                <div id="collapseColors" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <ul class="color-swatches">
                                            @foreach ($colors as $color)
                                                <li>
                                                    <a href="{{ url()->current() }}?color={{ $color }}" class="color-swatch" title="{{ ucfirst($color) }}"
                                                    style="background-color: {{ $color }}; border: 1px solid #ddd; width: 30px; height: 30px; display: inline-block; border-radius: 50%;">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Add other filters here -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select name="sort_price" onchange="location = this.value;">
                                    <option value="{{ url()->current() }}?{{ http_build_query(array_merge(request()->all(), ['sort_price' => 'low_high'])) }}" {{ request()->sort_price == 'low_high' ? 'selected' : '' }}>Low to High</option>
                                    <option value="{{ url()->current() }}?{{ http_build_query(array_merge(request()->all(), ['sort_price' => 'high_low'])) }}" {{ request()->sort_price == 'high_low' ? 'selected' : '' }}>High to Low</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="{{ route('frontend.shop_details', $product->id) }}">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}">
                                        <ul class="product__hover">
                                            {{-- <li><a href="#"><img src="{{ asset('front_images/icon/heart.png') }}" alt=""></a></li>
                                            <li><a href="#"><img src="{{ asset('front_images/icon/compare.png') }}" alt=""><span>Compare</span></a></li>
                                            <li><a href="#"><img src="{{ asset('front_images/icon/search.png') }}" alt=""></a></li> --}}
                                        </ul>
                                    </div>
                                </a>
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
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
