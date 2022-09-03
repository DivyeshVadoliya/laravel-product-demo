@extends('layouts.adminPenal')
@section('container')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="register-box col-8">
                <div class="card card-primary">
                    <div class="card card-header">
                        <h1>Change Password</h1>
                    </div>
                    <form action="{{ route('password.change.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card card-body">
                            <label>Old Password</label>
                            <div class="form-group pass_show mt-2 mb-4">
                                <input type="password" name="oldPassword" value="{{old('oldPassword')}}"
                                       class="form-control" placeholder="Old Password">
                                @error('oldPassword')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <label>New Password</label>
                            <div class="form-group pass_show mt-2 mb-4">
                                <input type="password" name="newPassword" value="{{old('newPassword')}}"
                                       class="form-control" placeholder="New Password">
                                @error('newPassword')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <label>Confirm Password</label>
                            <div class="form-group pass_show mt-2 mb-4 ">
                                <input type="password" name="confirmPassword" value="{{old('confirmPassword')}}"
                                       class="form-control" placeholder="Confirm Password">
                                @error('confirmPassword')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if(session('error'))
            alert("{{session('error')}}");
        @endif
    </script>
@endsection
