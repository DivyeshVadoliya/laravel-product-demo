@extends('formLayout')
@section('container')
    <div class="container-fluid mb-2 mt-2">
        <div class="small-box bg-success" style="height: 50px">
            <a href="{{route('admin.register')}}" class="small-box-footer" style="height: 50px">
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
                            <td>Admin,Seller,Buyer</td>
                            <td class="project-state">
                                <span class="badge badge-success">Active</span>
                                <span class="badge badge-danger">Inactive</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
