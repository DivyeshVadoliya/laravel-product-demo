@extends('layouts.adminPenal')
@section('container')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="register-box col-8">
                <div class="card card-primary">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="card-header ">
                        <p class="login-box-msg">Register a new membership</p>
                    </div>
                    <div class="card-body register-card-body">
                        <form action="{{route('admin.createUser')}}" method="post">
                            @csrf
                            <label class="col-12">
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Full name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="col-12">
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="col-12">
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="col-12">
                                <div class="form-group row">
                                    <div class="col-3"><span>Status</span></div>
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="radio" name="roll" value="admin" checked>
                                        <label class="form-check-label">Admin</label>
                                    </div>
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="radio" name="roll" value="seller" >
                                        <label class="form-check-label">Seller</label>
                                    </div>
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="radio" name="roll" value="buyer">
                                        <label class="form-check-label">Buyer</label>
                                    </div>
                                </div>
                            </label>
                            <label class="col-12">
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                        <label for="agreeTerms">
                                            I agree to the <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </form>
{{--                        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
