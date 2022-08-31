@extends('formLayout')
@section('container')
    <div class="container-fluid mb-2 mt-2">
        <div class="small-box bg-success" style="height: 50px">
            <a href="{{route('product.create')}}" class="small-box-footer" style="height: 50px">
                <h1>Add Product  <i class="fas fa-arrow-circle-right"></i></h1></a>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                No.
                            </th>
                            <th style="width: 20%">
                                Product Name
                            </th>
                            <th style="width: 10%" class="text-center">
                                Product User
                            </th>
                            <th style="width: 10%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                                Category
                            </th>
                            <th style="width: 20%" class="text-center">
                                Image
                            </th>
                            <th style="width: 15%" class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$product->name}} </td>
                                <td class="text-center"> {{$product->user->name}} </td>
                                <td class="project-state">
                                    <span class="{{($product->status == 'active') ?
                                        'badge badge-success' : 'badge badge-danger'}}">
                                        {{$product->status}}
                                    </span>
                                </td>
                                <td class="project_progress">
                                    @foreach($product->categories as $category)
                                        {{ $loop->first ? '' : ', ' }}
                                        {{$category->name}}
                                    @endforeach
                                </td>
                                <td class="project-state">
                                    <img src="{{ asset('/storage/images/'.$product->image) }}" width="50" height="40">
                                </td>
                                <td class="project-actions text-center">
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
            </div>
        </div>
    </section>
    {{$products->withQueryString()->links()}}
    <script>
        @if(session('product'))
            alert("{{session('product')}}");
        @endif
    </script>
@endsection
