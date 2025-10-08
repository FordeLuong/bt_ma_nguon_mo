@extends('layouts.app')

@section('title', 'Đăng ký tài khoản')

@section('meta-description', 'Đăng ký tài khoản My Blog để tạo và chia sẻ bài viết với cộng đồng')

@section('head')
<style>
    .auth-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }
    
    .auth-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
    }
    
    .auth-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .auth-body {
        padding: 2rem;
    }
    
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #f5576c;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
    
    .form-control:focus {
        border-color: #f5576c;
        box-shadow: 0 0 0 0.2rem rgba(245, 87, 108, 0.25);
    }
    
    .btn-register {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        color: white;
    }
    
    .btn-register:disabled {
        opacity: 0.7;
        transform: none;
    }
    
    .password-strength {
        margin-top: 0.5rem;
    }
    
    .password-strength-bar {
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .password-strength-fill {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    
    .strength-weak { background: #dc3545; width: 25%; }
    .strength-fair { background: #fd7e14; width: 50%; }
    .strength-good { background: #ffc107; width: 75%; }
    .strength-strong { background: #28a745; width: 100%; }
    
    .password-requirements {
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }
    
    .requirement {
        color: #6c757d;
        transition: color 0.3s ease;
    }
    
    .requirement.met {
        color: #28a745;
    }
    
    .requirement i {
        width: 16px;
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
        color: #f5576c;
    }
    
    .terms-checkbox {
        accent-color: #f5576c;
    }
    
    .social-login {
        border: 2px solid #e9ecef;
        color: #495057;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .social-login:hover {
        border-color: #f5576c;
        color: #f5576c;
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
            <i class="fas fa-user-plus fa-3x mb-3"></i>
            <h3 class="mb-0 fw-bold">Đăng ký tài khoản</h3>
            <p class="mb-0 opacity-75">Tạo tài khoản để bắt đầu hành trình!</p>
        </div>
        
        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}" data-loading>
                @csrf
                
                <!-- Full Name -->
                <div class="form-floating mb-3">
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           placeholder="Họ và tên"
                           value="{{ old('name') }}" 
                           required 
                           autocomplete="name" 
                           autofocus>
                    <label for="name">
                        <i class="fas fa-user me-2"></i>Họ và tên
                    </label>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                
                <!-- Email Address -->
                <div class="form-floating mb-3">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           placeholder="name@example.com"
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email">
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
                           autocomplete="new-password"
                           oninput="checkPasswordStrength(this.value)">
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
                    
                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="password-strength-bar">
                            <div class="password-strength-fill" id="strength-fill"></div>
                        </div>
                        <small class="text-muted" id="strength-text">Độ mạnh mật khẩu</small>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-requirements">
                        <div class="requirement" id="req-length">
                            <i class="fas fa-times"></i> Ít nhất 8 ký tự
                        </div>
                        <div class="requirement" id="req-uppercase">
                            <i class="fas fa-times"></i> Có chữ hoa
                        </div>
                        <div class="requirement" id="req-lowercase">
                            <i class="fas fa-times"></i> Có chữ thường
                        </div>
                        <div class="requirement" id="req-number">
                            <i class="fas fa-times"></i> Có số
                        </div>
                        <div class="requirement" id="req-special">
                            <i class="fas fa-times"></i> Có ký tự đặc biệt
                        </div>
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div class="form-floating mb-3 position-relative">
                    <input type="password" 
                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Xác nhận mật khẩu"
                           required 
                           autocomplete="new-password"
                           oninput="checkPasswordMatch()">
                    <label for="password_confirmation">
                        <i class="fas fa-lock me-2"></i>Xác nhận mật khẩu
                    </label>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                    </button>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="invalid-feedback" id="password-match-error" style="display: none;">
                        Mật khẩu xác nhận không khớp
                    </div>
                    <div class="valid-feedback" id="password-match-success" style="display: none;">
                        Mật khẩu khớp
                    </div>
                </div>
                
                <!-- Terms and Conditions -->
                <div class="form-check mb-4">
                    <input class="form-check-input terms-checkbox @error('terms') is-invalid @enderror" 
                           type="checkbox" 
                           name="terms" 
                           id="terms"
                           required>
                    <label class="form-check-label" for="terms">
                        Tôi đồng ý với 
                        <a href="#" class="text-decoration-none" style="color: #f5576c;" data-bs-toggle="modal" data-bs-target="#termsModal">
                            Điều khoản dịch vụ
                        </a> và 
                        <a href="#" class="text-decoration-none" style="color: #f5576c;" data-bs-toggle="modal" data-bs-target="#privacyModal">
                            Chính sách bảo mật
                        </a>
                    </label>
                    @error('terms')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                
                <!-- Register Button -->
                <button type="submit" class="btn btn-register" id="register-btn" disabled>
                    <i class="fas fa-user-plus me-2"></i>
                    <span class="btn-text">Đăng ký tài khoản</span>
                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                </button>
                
                <!-- Social Register (Optional) -->
                <div class="divider">
                    <span>Hoặc đăng ký với</span>
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
                
                <!-- Login Link -->
                <div class="text-center">
                    <p class="mb-0 text-muted">
                        Đã có tài khoản? 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #f5576c;">
                            Đăng nhập ngay
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Điều khoản dịch vụ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Đây là nội dung điều khoản dịch vụ...</p>
                <!-- Add your terms content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chính sách bảo mật</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Đây là nội dung chính sách bảo mật...</p>
                <!-- Add your privacy policy content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
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
    
    function checkPasswordStrength(password) {
        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');
        
        // Reset all classes
        strengthFill.className = 'password-strength-fill';
        
        // Check requirements
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /\d/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };
        
        // Update requirement indicators
        Object.keys(requirements).forEach(req => {
            const element = document.getElementById(`req-${req}`);
            const icon = element.querySelector('i');
            
            if (requirements[req]) {
                element.classList.add('met');
                icon.className = 'fas fa-check';
            } else {
                element.classList.remove('met');
                icon.className = 'fas fa-times';
            }
        });
        
        // Calculate strength
        const metCount = Object.values(requirements).filter(Boolean).length;
        
        if (password.length === 0) {
            strengthText.textContent = 'Độ mạnh mật khẩu';
            strengthFill.style.width = '0%';
        } else if (metCount < 3) {
            strengthFill.classList.add('strength-weak');
            strengthText.textContent = 'Yếu';
        } else if (metCount < 4) {
            strengthFill.classList.add('strength-fair');
            strengthText.textContent = 'Trung bình';
        } else if (metCount < 5) {
            strengthFill.classList.add('strength-good');
            strengthText.textContent = 'Tốt';
        } else {
            strengthFill.classList.add('strength-strong');
            strengthText.textContent = 'Mạnh';
        }
        
        checkFormValidity();
    }
    
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const confirmField = document.getElementById('password_confirmation');
        const errorMsg = document.getElementById('password-match-error');
        const successMsg = document.getElementById('password-match-success');
        
        if (confirmation.length === 0) {
            confirmField.classList.remove('is-valid', 'is-invalid');
            errorMsg.style.display = 'none';
            successMsg.style.display = 'none';
        } else if (password === confirmation) {
            confirmField.classList.remove('is-invalid');
            confirmField.classList.add('is-valid');
            errorMsg.style.display = 'none';
            successMsg.style.display = 'block';
        } else {
            confirmField.classList.remove('is-valid');
            confirmField.classList.add('is-invalid');
            errorMsg.style.display = 'block';
            successMsg.style.display = 'none';
        }
        
        checkFormValidity();
    }
    
    function checkFormValidity() {
        const form = document.querySelector('form[data-loading]');
        const registerBtn = document.getElementById('register-btn');
        const requiredFields = form.querySelectorAll('input[required]');
        const termsChecked = document.getElementById('terms').checked;
        const passwordsMatch = document.getElementById('password_confirmation').classList.contains('is-valid') || 
                             document.getElementById('password_confirmation').value === '';
        
        let allValid = true;
        
        // Check all required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                allValid = false;
            }
        });
        // Check password strength
        const strengthFill = document.getElementById('strength-fill');
        if (strengthFill.classList.contains('strength-weak') || strengthFill.style.width === '0%') {
            allValid = false;
        }
        if (termsChecked && passwordsMatch && allValid) {
            registerBtn.disabled = false;
        } else {
            registerBtn.disabled = true;
        }
    }
    document.getElementById('terms').addEventListener('change', checkFormValidity);
    document.querySelectorAll('input[required]').forEach(input => {
        input.addEventListener('input', checkFormValidity);
    });
</script>
@endsection