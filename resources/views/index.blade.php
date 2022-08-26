@extends('layout')
@section('title', 'Home')
@section('container')
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <div class="nav row">
                @if (Route::has('login'))
                    @auth
                        <div class="col-5">
                            <a href="{{ url('/') }}" class="nav-link active">{{Auth::user()->name}}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('LogOut') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('change.password.edit') }}" class="nav-link active">ChangePassword</a>
                        </div>
                    @else
                        <div class="col-5">
                            <a href="{{ route('login') }}" class="nav-link active">Login</a>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('register') }}" class="nav-link active">Register</a>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    @if(Auth::check())
        <div class="row">
            <div class="container mb-5 mt-5 col-4">
                <button type="button" class="btn btn-success"
                        onclick="window.location='{{ route("category.create") }}'">
                    Add Category
                </button>
            </div>
            <div class="container mb-5 mt-5 col-6">
                <button type="button" class="btn btn-success"
                        onclick="window.location='{{ route("product.create") }}'">
                    Add Product
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Status</th>
                        @if(Auth::check())
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="{{$category->status == 'inactive' ? 'table-secondary' : ''}}">
                        <td>{{$category->name}}</td>
                        <td>{{$category->status}}</td>
                        @if(Auth::check())
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
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$categories->withQueryString()->links()}}
        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Image</th>
                        @if(Auth::check())
                            <th>Action</th>
                        @endif
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
                        @if(Auth::check())
                        <td>
                            <form action="{{route('product.destroy', [$product->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a href="{{route('product.edit', [$product->id])}}"
                                   class="btn btn-info btn-sm">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$products->withQueryString()->links()}}
        </div>
    </div>
    <script>
        @if(session('massage'))
            alert("{{session('massage')}}");
        @elseif(session('success'))
            alert("{{session('success')}}");
        @endif
    </script>
@endsection
