<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Job Hunt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors/colors.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

    @stack('styles')
</head>

<body>
    <!-- Loader -->
    <div class="page-loading">
        <img src="{{ asset('images/loader.gif') }}" alt="Loading..." />
    </div>

    <!-- Main Layout -->
    <div class="theme-layout" id="scrollup">
        @include('layout.navbar')
        @yield('content')
        @include('layout.footer')
    </div>

    <!-- Login Popup -->
    <div class="account-popup-area signin-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>User Login</h3>
            <form action="{{ route('loginSave') }}" method="POST">
                @csrf
                <div class="cfield">
                    <input type="email" name="email" placeholder="Register Email" required />
                    <i class="la la-user"></i>
                </div>
                <div class="cfield">
                    <input type="password" name="password" placeholder="Password" required />
                    <i class="la la-key"></i>
                </div>
                <div class="profile-options">
                    <legend>Login As</legend>
                    <input id="p11" name="profile" type="radio" value="candidate" />
                    <label for="p11">Candidate</label>
                    <input id="p22" name="profile" type="radio" value="company" />
                    <label for="p22">Company</label>
                </div>
                <p class="remember-label">
                    <input type="checkbox" name="remember" id="cb1">
                    <label for="cb1">Remember me</label>
                </p>
                <a class="forget-popup" href="#" title="Forgot Password">Forgot Password?</a>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Signup Popup -->
    <div class="account-popup-area signup-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>Sign Up</h3>
            <form action="{{ route('registerSave') }}" method="POST">
                @csrf
                <div class="cfield">
                    <input type="text" name="name" placeholder="Username" required />
                    <i class="la la-user"></i>
                </div>
                <div class="cfield">
                    <input type="password" name="password" placeholder="Password" required />
                    <i class="la la-key"></i>
                </div>
                <div class="cfield">
                    <input type="email" name="email" placeholder="Email" required />
                    <i class="la la-envelope-o"></i>
                </div>
                <div class="cfield">
                    <input type="text" name="phone" placeholder="Phone Number" required />
                    <i class="la la-phone"></i>
                </div>
                <div class="profile-options">
                    <legend>Register As</legend>
                    <input id="p33" name="profile" type="radio" value="candidate" />
                    <label for="p33">Candidate</label>
                    <input id="p44" name="profile" type="radio" value="company" />
                    <label for="p44">Company</label>
                </div>
                <button type="submit">Signup</button>
            </form>
        </div>
    </div>

    <!-- Forgot Password Popup -->
    <div class="account-popup-area forget-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>Forgot Password</h3>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <p>Please enter your email address to receive a password reset link.</p>
                <div class="cfield">
                    <input type="email" name="email" placeholder="Email Address" required />
                    <i class="la la-envelope-o"></i>
                </div>
                <button type="submit">Send Reset Link</button>
            </form>
        </div>
    </div>

    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <span class="close-profile"><i class="la la-close"></i></span>

        @if (auth()->check())
            @php
                $user = auth()->user();
                $image = optional($user->candidate)->image
                      ?? optional($user->admin)->image ?? optional($user->company)->company_image
                      ?? 'default.jpg';
                $fullImagePath = 'images/resource/' . $image;
                $roleLabel = optional($user->candidate)->job_title
                          ?? optional($user->company)->company_name
                          ?? 'Administrator';
                $city = optional($user->candidate)->city ?? optional($user->company)->city ?? optional(value: $user->admin)->city ??'';
                $country = optional($user->candidate)->country ?? optional($user->company)->country ?? optional($user->admin)->country ?? '';
            @endphp

            <div class="can-detail-s">
                <div class="cst">
                    <img src="{{ asset($fullImagePath) }}" alt="User Image" />
                </div>
                <h3>{{ ucfirst($user->name ?? '') }}</h3>
                <span><i>Job:</i> {{ $roleLabel }}</span>
                <p>Email: {{ $user->email ?? 'N/A' }}</p>
                <p>Member Since, {{ \Carbon\Carbon::parse($user->created_at)->format('Y') ?? 'N/A' }}</p>
                <p><i class="la la-map-marker"></i> {{ $city }} / {{ $country }}</p>
            </div>

            <div class="tree_widget-sec">
                @include('layout.slidebar')
            </div>
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/parallax.js') }}"></script>
    <script src="{{ asset('js/select-chosen.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

    @stack('scripts')
</body>
</html>
