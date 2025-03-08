<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form - PayBuddy</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            width: 480px; /* Slightly larger form size */
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 50px; /* Add margin from the top */
            margin-bottom: 50px; /* Add margin to the bottom */
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
        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 30px;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #ddd;
            margin: 0 10px;
        }
        .text-center a {
            color: #007bff;
            font-weight: 600;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- PayBuddy Header -->
                <h1 class="paybuddy-header">PayBuddy</h1>
                
                <h3 class="card-title text-center mb-4" style="font-weight: 600; font-size: 1.4rem; color: #333;">Create Your Account</h3>
                <p class="text-center mb-4" style="color: #666;">Fill in the details below to sign up for a new PayBuddy account.</p>
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
    
                <form method="POST" action="{{ route('process-register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name', request()->cookie('name')) }}" 
                            id="name" name="name" placeholder="Enter your Name" 
                            required 
                            autofocus >
        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" 
                            name="email" 
                            placeholder="Enter your email" 
                            value="{{ old('email', request()->cookie('email')) }}"
                            required
                            autofocus
                         >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password" 
                            placeholder="Enter your password"
                            required
                            autofocus
                           >
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="confirm_password" 
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            required
                            autofocus
                            >
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
                </form>
                
                <div class="divider">OR</div>
                
                <div class="d-grid mt-4">
                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-google"></i> Sign up with Google
                    </button>
                </div>
    
                <div class="text-center mt-4">
                    <span>Already have an account? </span>
                    <a href="{{ url('/') }}" class="fw-bold">Login here</a>
                </div>
            </div>
        </div>
    
    </div>
   
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
