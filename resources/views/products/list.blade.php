@extends('layouts.app')
<style>
.bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white;
    background: #5bc0de;
    padding-left: 9px;
    text-align: center;
}

.bootstrap-tagsinput {
    width: 100%;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Product List</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
        </div>
    </div>
    <div class="row">
    @if($productList->isEmpty())
        <div class="col-12 text-center">
            <h4 class="mt-5">No products available at the moment.</h4>
        </div>
    @else
        @foreach($productList as $data)
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <a href="{{ route('products.detail', $data->slug) }}">
                        <img class="card-img-top" src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->name }}</h5>
                        @if($data->current_price != $data->base_price)
                            <p>
                                <del>Rs. {{ $data->base_price }}</del>
                                <strong class="text-success">Now: Rs. {{ $data->current_price }}</strong>
                            </p>
                        @else
                            <p>Price: Rs. {{ $data->base_price }}</p>
                        @endif
                        <a href="{{ route('products.detail', $data->slug) }}" class="btn btn-primary">View Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>


</div>
</div>
@endsection