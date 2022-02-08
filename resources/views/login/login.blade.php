@extends('layouts.auth');
@section('content')

    <!-- Log In page -->
    <div class="row vh-100 ">
        <div class="col-12 align-self-center">
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="auth-logo-box">
                                <a href="#" class="logo logo-admin">
                                    <img src="{{ asset('') }}images/logo.png" height="55" alt="logo"
                                        class="auth-logo">
                                </a>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <h2 class="text-center mt-3 mb-2">Login Form</h4>
                                <form id="auth" class="mt-3" method="POST" action="{{ url('/') }}">
                                    @csrf
                                    <div class="form-group mt-4">
                                        <label>Email Address</label>
                                        <input type="email" name="username"
                                            class="form-control @error('username')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Enter your email address" />
                                        @error('username')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Enter your password" />
                                        @error('password')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </form>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end auth-page-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection
