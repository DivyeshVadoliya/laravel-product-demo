@extends('layout')
@section('title', 'Home')

@section('container')
    <div class="row">
        <div class="container mb-5 mt-5 col-4">
            <a class="btn btn-success" href="{{ route('category.create') }}">Add Category</a>
        </div>
        <div class="container mb-5 mt-5 col-6">
            <a class="btn btn-success" href="{{ route('product.create') }}">Add Product</a>
        </div>
    </div>
    <div class="col-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="{{$category->status == 'inactive' ? 'table-secondary' : ''}}">
                    <td>{{$category->name}}</td>
                    <td>{{$category->status}}</td>
                    <td>
                        <form action="{{route('category.destroy', [$category->id])}}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('category.edit', [$category->id])}}"
                               class="btn btn-info btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$categories->appends(request()->query())->links()}}
    </div>
    <div class="col-8">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="{{$product->status == 'inactive' ? 'table-secondary' : ''}}">
                    <td>{{$product->name}}</td>
                    <td>{{$product->status}}</td>
                    <td>
                        @foreach($product->categories as $category)
                            {{ $loop->first ? '' : ', ' }}
                           {{$category->name}}
                        @endforeach
                    </td>
                    <td>
                        <img src="{{ asset('/storage/images/'.$product->image) }}" width="50" height="40">
                    </td>
                    <td>
                        <form action="{{route('product.destroy', [$product->id])}}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('product.edit', [$product->id])}}"
                               class="btn btn-info btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->appends(request()->query())->links()}}
    </div>
    <script>
        @if(session('massage'))
            alert("{{session('massage')}}");
        @endif
    </script>
@endsection
