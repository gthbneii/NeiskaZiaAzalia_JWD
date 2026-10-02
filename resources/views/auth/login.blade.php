@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header text-white text-center py-3" style="background-color: #43c7d6;">
                    <h5 class="mb-0 fw-bold">Login Admin</h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                placeholder="admin@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="******">
                        </div>
                        <button type="submit" class="btn text-white w-100 fw-bold" style="background-color: #43c7d6;">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
