<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>Login - PayBuddy</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            width: 480px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .paybuddy-header {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }
        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            border-radius: 8px;
            border-color: #ccc;
            font-size: 1rem;
            padding: 15px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 12px;
            font-size: 1.1rem;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .google-btn {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #555;
            font-weight: 600;
            padding: 12px;
            font-size: 1.1rem;
        }
        .google-btn i {
            margin-right: 8px;
        }
        .google-btn:hover {
            background-color: #f7f7f7;
            color: #333;
        }
        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #ddd;
            margin: 0 10px;
        }
        .form-check-label {
            font-weight: 600;
            color: #495057;
        }
        .form-check-input {
            border-radius: 4px;
        }
        .login-footer {
            text-align: center;
            margin-top: 30px;
        }
        .login-footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    {{-- /@dump(session()->all()) --}}


    <div class="card shadow-sm">
        <div class="card-body">
            <!-- PayBuddy Header -->
            <h1 class="paybuddy-header">PayBuddy</h1>
            
            <h3 class="card-title text-center mb-4" style="font-weight: 600; font-size: 1.4rem; color: #333;">Welcome Back!</h3>
            <p class="text-center mb-4" style="color: #666;">Please log in to continue using your account.</p>

            <!-- Flash Messages -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{route('process-login')}}" id="login">
              @csrf <!-- CSRF token for Laravel -->
             
              <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', request()->cookie('email')) }}" 
                        id="email" name="email" placeholder="Enter your email" 
                        required 
                        autofocus >

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <!-- Remember Me Checkbox -->
                <div class="mb-4 form-check">
                    <input  type="checkbox" 
                    id="remember" 
                    name="remember" 
                    {{ old('remember', request()->cookie('remember') ? 'checked' : '') }}
                    >
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
              
                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            </form>
            
            <div class="divider my-4">OR</div>
            
            <div class="d-grid">
                <button class="btn google-btn">
                    <i class="bi bi-google"></i> Continue with Google
                </button>
            </div>
            
            <div class="login-footer">
                <span>Don't have an account? </span>
                <a href="{{route('register')}}" class="text-decoration-none">Register here</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
