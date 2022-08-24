@extends('layout')
@section('title', 'Product')
@section('container')
    <div class="container mb-5 mt-5">
        <a class="btn btn-success" href="{{ route('index') }}">Back</a>
    </div>
    <div class="col-4">
        <h2>Product</h2>
        <form
            action="{{isset($product) ?
            @route('product.update', $product->id) : @route('product.store')}}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset
            <div class="mb-3 mt-3">
                <label for="name">Add/Edit Product</label>
                <label>
                    <input type="text" class="form-control" name="name"
                           value='{{ $product->name ?? old('name')}}'>
                </label>
                @error('name')
                    <span>{{$message}}</span>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-2" for="name">Status</label>
                <div class="form-check col-3">
                    <label>
                        <input type="radio" class="form-check-input radio1"
                               name="status" value="active"
                            {{((old('status') == 'active') ||
                            (isset($product) && $product->status ==  'active')) ?
                            "checked" : ''}} >
                    </label>
                        <label class="form-check-label" for="radio1">Active</label>
                    </div>
                    <div class="form-check col-3">
                        <label>
                            <input type="radio" class="form-check-input radio2"
                                   name="status" value="inactive"
                                {{((old('status') == 'inactive') ||
                                (isset($product) && $product->status == 'inactive' && (old('status') != 'active'))) ?
                                "checked" : ''}}>
                    </label>
                    <label class="form-check-label" for="radio2">Inactive</label>
                </div>
                @error('status')
                    <span>{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Image</label>
                <label>
                    <input type="file" class="form-control" name="image" value={{old('image')}}>
                </label>
                <label>
                    @isset($product)
                        <img src="{{ asset('/storage/images/'.$product->image) }}" width="50" height="40">
                        <input type="hidden" name="oldImage" value='{{ $product->image }}'>
                    @endisset
                </label>
                @error('image')
                    <span>{{$message}}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label for="name" class="input-group-text">Category</label>
                <label>
                    <select class="form-control" name="category[]" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                {{ (isset($product) && $product->categories->contains($category) == 1)
                                    || (collect(old('category'))->contains($category->id))
                                    ? 'selected' : '' }}>
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </label>
                @error('category')
                <span>{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
