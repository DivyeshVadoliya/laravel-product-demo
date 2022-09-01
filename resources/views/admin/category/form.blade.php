@extends('layouts.adminPenal')
@section('container')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="register-box col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit Category</h3>
                    </div>
                    <form action="{{isset($category) ?
                          @route('category.update', $category->id) :
                          @route('category.store')}}"
                          method="POST">
                        @csrf
                        @isset($category)
                            @method('PUT')
                        @endisset
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Category name"
                                       value='{{ $category->name ?? old('name')}}'>
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-3"><label>Status</label></div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="status" value="active"
                                        {{((old('status') == 'active') ||
                                            (isset($category) && $category->status ==  'active')) ?
                                            "checked" : ''}}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="status" value="inactive"
                                        {{((old('status') == 'inactive') ||
                                            (isset($category) && $category->status == 'inactive' &&
                                             (old('status') != 'active'))) ?
                                            "checked" : ''}}>
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                @error('status')
                                    <span>{{$message}}</span>
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
