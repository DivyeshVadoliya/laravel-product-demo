@extends('formLayout')
@section('container')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="register-box col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit Product</h3>
                    </div>
                    <form action="{{isset($product) ?
                          @route('product.update', $product->id) :
                          @route('product.store')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($product)
                            @method('PUT')
                        @endisset
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Product name"
                                       value='{{ $product->name ?? old('name')}}'>
                                @error('name')
                                    <span class="form-control is-warning">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-3"><label>Status</label></div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="status" value="active"
                                        {{((old('status') == 'active') ||
                                            (isset($product) && $product->status ==  'active')) ?
                                            "checked" : ''}}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="status" value="inactive"
                                        {{((old('status') == 'inactive') ||
                                            (isset($product) && $product->status == 'inactive' &&
                                             (old('status') != 'active'))) ?
                                            "checked" : ''}}>
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                @error('status')
                                    <span class="form-control is-warning">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-13">
                                <label for="exampleInputFile">Image</label>
                                <input type="file" class="form-control" name="image" value={{old('image')}}>
                                <label>
                                    @isset($product)
                                        <img src="{{ asset('/storage/images/'.$product->image) }}" width="50" height="40">
                                        <input type="hidden" name="oldImage" value='{{ $product->image }}'>
                                    @endisset
                                </label>
                                @error('image')
                                    <span class="form-control is-warning">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Category</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0"
                                        name="category[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{ (isset($product) && $product->categories->contains($category) == 1)
                                                || (collect(old('category'))->contains($category->id))
                                                ? 'selected' : '' }}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="form-control is-warning">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
