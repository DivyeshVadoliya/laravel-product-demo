@extends('layout')
@section('title', 'Product')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('change.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mt-4">
                        <h2> Change Password</h2>
                    </div>
                    <label>Old Password</label>
                    <div class="form-group pass_show mt-2 mb-4">
                        <input type="password" name="oldPassword" value="{{old('oldPassword')}}" class="form-control" placeholder="Old Password">
                        @error('oldPassword')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show mt-2 mb-4">
                        <input type="password" name="newPassword" value="{{old('newPassword')}}" class="form-control" placeholder="New Password">
                        @error('newPassword')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show mt-2 mb-4 ">
                        <input type="password" name="confirmPassword" value="{{old('confirmPassword')}}" class="form-control" placeholder="Confirm Password">
                        @error('confirmPassword')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        @if(session('error'))
            alert("{{session('error')}}");
        @endif
    </script>
@endsection
