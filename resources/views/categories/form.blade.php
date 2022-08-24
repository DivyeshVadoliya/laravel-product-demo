@extends('layout')
@section('title', 'Category')
@section('container')
    <div class="container mb-5 mt-5">
        <a class="btn btn-success" href="{{ route('index') }}">Back</a>
    </div>
    <div class="col-4">
        <h2>Category</h2>
        <form
            action="{{isset($category) ?  @route('category.update', $category->id) : @route('category.store')}}"
            method="POST">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset
            <div class="mb-3 mt-3">
                <label for="name">Add/Edit Category</label>
                <label>
                    <input type="text" class="form-control" name="name"
                           value='{{ $category->name ?? old('name')}}'>
                </label>
                @error('name')
                    <span>{{$message}}</span>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-2" for="name">Status</label>
                <div class="form-check col-3">
                    <label>
                        <input type="radio" class="form-check-input radio1" name="status" value="active"
                            {{((old('status') == 'active') ||
                                (isset($category) && $category->status ==  'active')) ?
                                "checked" : ''}}>
                    </label>
                    <label class="form-check-label" for="radio1">Active</label>
                </div>
                <div class="form-check col-3">
                    <label>
                        <input type="radio" class="form-check-input radio2" name="status" value="inactive"
                            {{((old('status') == 'inactive') ||
                                (isset($category) && $category->status == 'inactive' && (old('status') != 'active'))) ?
                                 "checked" : ''}}>
                    </label>
                    <label class="form-check-label" for="radio2">Inactive</label>
                </div>
                @error('status')
                    <span>{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
