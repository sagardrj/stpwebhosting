@extends('layouts.app')
<style>
span {
    cursor: pointer;
}

.number {
    margin: 100px;
}

.minus,
.plus {
    width: 30px;
    height: 35px;
    background: #f2f2f2;
    border-radius: 4px;
    padding: 6px 5px 8px 5px;
    border: 1px solid #ddd;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
}

input {
    height: 34px;
    width: 100px;
    text-align: center;
    font-size: 26px;
    border: 1px solid #ddd;
    border-radius: 4px;
    display: inline-block;
    vertical-align: middle;
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Product Detail</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('products.index') }}" class="btn btn-info">Back</a>
        </div>
    </div>
    <div class="row">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="col-md-6">
            <img class="card-img-top" src="{{ asset('storage/' . $productDetail->image) }}"
                alt="{{$productDetail->name}}">
        </div>
        <div class="col-md-6">
            <div class="product_name">
                <h6>Product Name : - {{$productDetail->name}}</h6>
            </div>
            <div class="product_name">
                <h6>Description : - {!! $description !!}</h6>
            </div>
            @if($productDetail->current_price != $productDetail->base_price)
            <p>
                <del>Rs. {{ $productDetail->base_price }}</del>
                <strong class="text-success">Now: Rs. {{ $productDetail->current_price }}</strong>
            </p>
            @else
            <p>Price: Rs. {{ $productDetail->base_price }}</p>
            @endif
            <div class="stock">
            <h4>In Stock : <span id="stock_in" class="{{ $productDetail->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">{{ $productDetail->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}</span></h4>
            </div>
            <div class="number">
                <span class="minus">-</span>
                <input type="text" id="quantity_total" value="1" />
                <span class="plus" data-product-id="{{ $productDetail->id }}">+</span>
            </div>
            @if($productDetail->stock_quantity > 0)
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyModal">BUY</button>
            @else
            <p class="text-danger">This product is out of stock.</p>
            @endif
        </div>

    </div>
    @if($productDetail->stock_quantity > 0)
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                <input type="hidden" name="quantity" id="buyQuantity" value="1">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyModalLabel">Buy Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control text-start" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control text-start" required />
                        </div>
                        <div class="mb-3">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control text-start" name="contact_number" required />
                        </div>
                        <div class="mb-3">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control text-start" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Confirm Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

@endsection