<x-guest-layout>
    <form id="loginForm" class="card" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card-header">Login Form</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-outline" data-mdb-input-init>
                        @error('email')
                            <i class="fas fa-exclamation-circle trailing text-danger"></i>
                        @enderror
                        <input type="text" id="email" name="email" class="form-control form-icon-trailing @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus required />
                        <label class="form-label" for="email">Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline" data-mdb-input-init>
                        @error('password')
                            <i class="fas fa-exclamation-circle trailing text-danger"></i>
                        @enderror
                        <input type="password" id="password" name="password" class="form-control form-icon-trailing @error('password') is-invalid @enderror" autofocus required />
                        <label class="form-label" for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="form-check mb-0">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label style="font-size: 14px;" class="form-check-label" for="remember">Keep me logged in</label>
                            </div>
                        </div>
                        {{-- <div class="d-flex align-items-center">
                            <a style="font-size: 14px;" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-grid">
                        <button type="submit" id="loginButton" class="btn btn-primarybtn btn-primary text-capitalize shadow-none">
                            <span class="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                            <span class="button-text">Login</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-grid text-center">
                        <span style="font-size: 14px;">
                            <span>Don't have an account?</span>
                            <a href="{{ route('register') }}">Register</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-guest-layout>
