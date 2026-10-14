@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header text-white text-center py-3" style="background-color: #43c7d6;">
                    <h5 class="mb-0 fw-bold">Login Portal Sertifikasi</h5>
                </div>
                <div class="card-body p-4">

                    @if (session('success'))
                        <div class="alert alert-success py-2 mb-3 text-center" style="font-size: 0.85rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-3" style="font-size: 0.85rem;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Opsi Login</label>
                            <select name="role" class="form-select" required>
                                <option value="">Login Sebagai</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Peserta)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="nama@email.com"
                                autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="••••••••"
                                autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn text-white w-100 fw-bold"
                            style="background-color: #43c7d6;">Login</button>

                        <div style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: #555;">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                style="color: #36C5D8; font-weight: 600; text-decoration: none;">
                                Daftar / Register di sini
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
