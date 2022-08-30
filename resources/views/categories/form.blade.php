@extends('formLayout')
@section('container')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="register-box col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Category name">
                            </div>
                            <div class="form-group row">
                                <div class="col-3"><label>Status</label></div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="radio1">
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check col-3">
                                    <input class="form-check-input" type="radio" name="radio1" checked="">
                                    <label class="form-check-label">Inactive</label>
                                </div>
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
