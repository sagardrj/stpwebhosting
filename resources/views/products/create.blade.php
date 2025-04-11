@extends('layouts.app')
<style>
    .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white;
    background: #5bc0de;
    padding-left: 9px;
    text-align: center;
}
.bootstrap-tagsinput{
    width: 100%;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Create Product</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="col-md-8 mt-2">
        <label>Product Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="col-md-8 mt-3">
        <label>Product Image <span class="text-danger">*</span></label>
        <input type="file" name="image" class="form-control" >
        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="col-md-8 mt-3">
        <label>Base Price (Rs.) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" name="base_price" class="form-control" value="{{ old('base_price') }}" >
        @error('base_price') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="col-md-8 mt-3">
        <label>Override Price (Optional)</label>
        <input type="number" step="0.01" name="override_price" class="form-control" value="{{ old('override_price') }}">
        
        </div>
        <div class="col-md-8 mt-3">
        <label>Override Start Date</label>
        <input type="date" name="override_start_date" class="form-control" value="{{ old('override_start_date') }}">
        
        </div>
        <div class="col-md-8 mt-3">
        <label>Override End Date</label>
        <input type="date" name="override_end_date" class="form-control" value="{{ old('override_end_date') }}">
        
        </div>
        <div class="col-md-8 mt-3">
        <label>Stock Quantity <span class="text-danger">*</span></label>
        <input type="number" name="stock_quantity" class="form-control" min="1" value="{{ old('stock_quantity') }}" >
        @error('stock_quantity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-8 mt-3">
        <label>Description (English) <span class="text-danger">*</span></label>
        <textarea name="description_en" class="form-control" >{{ old('description_en') }}</textarea>
        @error('description_en') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-8 mt-3">
        <label>Description (Spanish) <span class="text-danger">*</span></label>
        <textarea name="description_es"  class="form-control">{{ old('description_es') }}</textarea>
        @error('description_es') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-8 mt-3 u-tagsinput">
        <label class="w-100">Tags (comma-separated)</label>
        <input type="text" name="tags" value="{{ old('tags') }}" data-role="tagsinput" class="form-control w-100" />
        
        </div>
        <div class="mt-3">
        <button class="btn btn-success" type="submit">Create Product</button>
</div>
    </form>
</div>
</div>
@endsection
