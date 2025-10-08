@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('meta-description', 'Đăng nhập vào My Blog để quản lý bài viết và tham gia cộng đồng')

@section('head')
<style>
    .auth-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .auth-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 450px;
    }
    
    .auth-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .auth-body {
        padding: 2rem;
    }
    
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #667eea;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-login:disabled {
        opacity: 0.7;
        transform: none;
    }
    
    .social-login {
        border: 2px solid #e9ecef;
        color: #495057;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .social-login:hover {
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-1px);
    }
    
    .divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #dee2e6;
    }
    
    .divider span {
        background: #fff;
        padding: 0 1rem;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        z-index: 10;
    }
    
    .password-toggle:hover {
        color: #667eea;
    }
    
    .remember-me {
        accent-color: #667eea;
    }
    
    @media (max-width: 576px) {
        .auth-container {
            padding: 1rem;
        }
        
        .auth-header,
        .auth-body {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <i class="fas fa-user-circle fa-3x mb-3"></i>
            <h3 class="mb-0 fw-bold">Đăng nhập</h3>
            <p class="mb-0 opacity-75">Chào mừng bạn trở lại!</p>
        </div>
        
        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}" data-loading>
                @csrf
                
                <!-- Email Address -->
                <div class="form-floating mb-3">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           placeholder="name@example.com"
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Địa chỉ email
                    </label>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="form-floating mb-3 position-relative">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Mật khẩu"
                           required 
                           autocomplete="current-password">
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Mật khẩu
                    </label>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input remember-me" 
                               type="checkbox" 
                               name="remember" 
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                            <small>Quên mật khẩu?</small>
                        </a>
                    @endif
                </div>
                
                <!-- Login Button -->
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    <span class="btn-text">Đăng nhập</span>
                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                </button>
                
                <!-- Social Login (Optional) -->
                <div class="divider">
                    <span>Hoặc đăng nhập với</span>
                </div>
                
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <button type="button" class="btn social-login w-100">
                            <i class="fab fa-google text-danger me-2"></i>Google
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn social-login w-100">
                            <i class="fab fa-facebook text-primary me-2"></i>Facebook
                        </button>
                    </div>
                </div>
                
                <!-- Register Link -->
                <div class="text-center">
                    <p class="mb-0 text-muted">
                        Chưa có tài khoản? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #667eea;">
                            Đăng ký ngay
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            field.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
    
    // Enhanced form submission
    document.querySelector('form[data-loading]').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const btnText = submitBtn.querySelector('.btn-text');
        const spinner = submitBtn.querySelector('.spinner-border');
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.textContent = 'Đang xử lý...';
        spinner.classList.remove('d-none');
        
        // Re-enable after 10 seconds (failsafe)
        setTimeout(() => {
            submitBtn.disabled = false;
            btnText.textContent = 'Đăng nhập';
            spinner.classList.add('d-none');
        }, 10000);
    });
    
    // Auto-focus on first error field
    document.addEventListener('DOMContentLoaded', function() {
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.focus();
        }
    });
    
    // Social login handlers (customize as needed)
    document.querySelectorAll('.social-login').forEach(btn => {
        btn.addEventListener('click', function() {
            const provider = this.textContent.trim().toLowerCase();
            // Add your social login logic here
            console.log('Social login with:', provider);
        });
    });
</script>
@endsection