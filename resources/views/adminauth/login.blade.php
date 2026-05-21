<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>

<body>
    <div class="container">
        <!-- Login Form Section -->
        <div class="login-section">
            <div class="logo-wrapper">
                <div class="logo">
                    <img src="{{ asset('logo1.jpeg/')}}" alt="Logo">
                </div>
                <h1>GYANPITH HIGH SCHOOL</h1>
                <p class="subtitle">Admin Login Panel</p>
            </div>
            @if (session('status'))
            <div class="alert success" style="display:flex;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="input-group">
                    <label for="username">Username or Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your username or email">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror

                    </div>
                </div>

                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" { old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="login-button" id="loginButton">
                    <span id="buttonText">Sign In</span>
                    <div class="loader" id="loader"></div>
                </button>
            </form>
        </div>
    </div>

</body>

</html>