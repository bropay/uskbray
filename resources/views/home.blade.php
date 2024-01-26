@extends('layouts.app') @section('content')
<div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 3%);">
    <div class="container">
        <div class="row gx-lg-5 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-5 fw-bold ls-tight text-white">
                    About the App <br />
                    <span class="text-primary">Code of Conduct Violations</span>
                </h1>
                <p style="color: hsl(0, 0%, 100%);">
                    This application was created to assist BP / BK teachers in recording and documenting all forms of violations of the rules that occur at school, making it easier to handle and be able to minimize the forms of violations.
forms of violations.
                </p>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card" style="background:rgb(255, 255, 255); border-radius:50px">
                    <div class="card-body py-5 px-md-5">
                        <h1 class="my-3 display-5 fw-bold ls-tight login" style="color: rgb(0, 0, 0)" >
                            Login
                        </h1>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-outline mb-3">
                                <label class="form-label">Username :</label>
                                <input type="text" name="username" value="{{old('username')}}" class="form-control" />
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label">Password :</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Sign In
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
