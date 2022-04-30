@extends('layouts.one-column-layout')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex justify-content-center align-items-center vh-100">
                <form class="card login animate__animated animate__zoomIn">
                    <div class="card-body">
                        <h4 class="card-title">Login</h4>
                        <hr>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control username" autocomplete="current-username">
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control password" autocomplete="current-password">
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-primary float-end">Login</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{url('forgot-password')}}">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection