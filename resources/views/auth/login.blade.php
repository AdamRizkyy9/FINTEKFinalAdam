@extends('layouts.app')

@section('content')
    <style>
        body {
            overflow: hidden;
        }

        .card-container {
            height: 100vh; /* Adjust this value based on your design */
            overflow-y: auto; /* Add this property to enable scrolling inside the card */
        }
    </style>

    <body class="bg-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 card-container">
                    <div class="card o-hidden my-5 border-10 shadow-lg">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        </div>
                                        <form method="post" action="{{ route('login') }}" class="login100-form validate-form">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="form-group form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary col-12">
                                                Login
                                            </button>
                                            <div class="signup-link">
                                                Don't have an account? <a href="{{ route('register')}}">Register</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGA0xmn1MuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>

@endsection
