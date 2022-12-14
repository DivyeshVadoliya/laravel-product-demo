@extends('layouts.adminPenal')
@section('container')
    <div class="container-fluid mb-2 mt-2">
        <div class="small-box bg-success" style="height: 50px">
            <a href="{{route('user.create')}}" class="small-box-footer" style="height: 50px">
                <h1>Add User <i class="fas fa-arrow-circle-right"></i></h1></a>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                No.
                            </th>
                            <th style="width: 20%">
                                Admin Name
                            </th>
                            <th style="width: 20%">
                                Admin EmailID
                            </th>
                            <th style="width: 20%">
                                Admin Roll
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%" class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roll}}</td>
                            <td class="project-state">
                                <span class="{{($user->status == 'active') ?
                                        'badge-success' : 'badge-danger'}}">
                                    {{$user->status}}
                                </span>
                            </td>
                            <td class="project-actions text-right">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{route('user.edit', [$user->id])}}"
                                           class="btn btn-info btn-sm">Edit</a>
                                    </div>
                                    <div class="col-4">
                                        <form action="{{route('user.destroy', [$user->id])}}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        @if(session('massage'))
            alert("{{session('massage')}}");
        @endif
    </script>
@endsection
