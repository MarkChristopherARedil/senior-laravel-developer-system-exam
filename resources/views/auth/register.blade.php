<x-guest-layout>

    <form class="card" action="{{ route('register') }}" method="POST">
        <div class="card-header bg-light">Registration Form</div>
        <div class="card-body">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-outline" data-mdb-input-init>
                        @error('name')
                            <i class="fas fa-exclamation-circle trailing text-danger"></i>
                        @enderror
                        <input type="text" id="name" name="name" class="form-control form-icon-trailing @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                        <label class="form-label" for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline" data-mdb-input-init>
                        @error('email')
                            <i class="fas fa-exclamation-circle trailing text-danger"></i>
                        @enderror
                        <input type="text" id="email" name="email" class="form-control form-icon-trailing @error('name') is-invalid @enderror" value="{{ old('email') }}" />
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
                        <input type="password" id="password" name="password" class="form-control form-icon-trailing @error('password') is-invalid @enderror" />
                        <label class="form-label" for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline" data-mdb-input-init>
                        @error('password_confirmation')
                            <i class="fas fa-exclamation-circle trailing text-danger"></i>
                        @enderror
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-icon-trailin @error('password_confirmation') is-invalid @enderror" />
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary text-capitalize shadow-none"
                            data-mdb-ripple-init>Register</button>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-grid text-center">
                        <span style="font-size: 14px;">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">Login</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-guest-layout>
