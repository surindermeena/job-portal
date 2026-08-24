<!-- reset-password.blade.php -->
@extends('layout.app') <!-- Or your layout -->

@section('content')
    <section class="overlape">
        <div class="block no-padding">
            <div data-velocity="-.1"
                style="background: url('{{ asset('images/resource/mslider1.jpg') }}') repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible no-parallax">
            </div>
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header text-center">
                            <h3>{{ Auth::user()->name ?? "Reset Password" }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row justify-content-center"> <!-- Centers the form horizontally -->
                <div class="col-md-6 col-lg-5"> <!-- Responsive form width -->
                    <div class="card shadow-sm border-0 mt-5">
                        <div class="card-body p-4">
                            <h3 class="text-center mb-4">Reset Password</h3>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <!-- Email -->
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password" required>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm new password" required>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection