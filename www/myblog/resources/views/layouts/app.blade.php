<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta-description', 'My Blog - Chia sẻ kiến thức và kinh nghiệm')">
    <meta name="keywords" content="@yield('meta-keywords', 'blog, laravel, php, web development')">
    
    <title>@yield('title', 'My Blog') - Laravel App</title>
    
    <!-- Preload key resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-bg: #f8f9fa;
            --border-color: #dee2e6;
            --primary-color: #0d6efd;
            --dark-bg: #212529;
            --text-muted: #6c757d;
        }
        
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            position: sticky;
            top: 56px;
            overflow-y: auto;
        }
        
        .main-content {
            min-height: calc(100vh - 56px);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .list-group-item.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .recent-posts-item {
            transition: all 0.2s ease-in-out;
        }
        
        .recent-posts-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        
        .alert {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            font-size: 1.2em;
        }
        
        footer {
            margin-top: auto;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-wrapper {
            flex: 1;
        }
        
        /* Loading animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        /* Responsive improvements */
        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                min-height: auto;
            }
            
            .main-content {
                min-height: auto;
            }
        }
    </style>
    
    @stack('styles')
    @yield('head')
</head>
<body>
    <div class="main-wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('posts.index') }}" aria-label="Trang chủ My Blog">
                    <i class="fas fa-blog me-2" aria-hidden="true"></i>My Blog
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}" 
                               href="{{ route('posts.index') }}" aria-current="{{ request()->routeIs('posts.index') ? 'page' : 'false' }}">
                                <i class="fas fa-home me-1" aria-hidden="true"></i>Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('posts.create') ? 'active' : '' }}" 
                               href="{{ route('posts.create') }}" aria-current="{{ request()->routeIs('posts.create') ? 'page' : 'false' }}">
                                <i class="fas fa-plus me-1" aria-hidden="true"></i>Tạo bài viết
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" 
                                   aria-expanded="false" aria-label="Menu người dùng">
                                    <i class="fas fa-user me-1" aria-hidden="true"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') ?? '#' }}">
                                            <i class="fas fa-user-edit me-2" aria-hidden="true"></i>Hồ sơ
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cog me-2" aria-hidden="true"></i>Cài đặt
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2" aria-hidden="true"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1" aria-hidden="true"></i>Đăng nhập
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1" aria-hidden="true"></i>Đăng ký
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="container-fluid" style="margin-top: 56px;">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 sidebar d-none d-md-block p-3" role="complementary">
                    <nav aria-label="Sidebar navigation">
                        <div class="list-group">
                            <a href="{{ route('posts.index') }}" 
                               class="list-group-item list-group-item-action {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                                <i class="fas fa-list me-2" aria-hidden="true"></i>Danh sách bài viết
                            </a>
                            <a href="{{ route('posts.create') }}" 
                               class="list-group-item list-group-item-action {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                                <i class="fas fa-plus me-2" aria-hidden="true"></i>Tạo bài viết mới
                            </a>
                            @can('manage-users')
                            <a href="{{ route('users.index') ?? '#' }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-users me-2" aria-hidden="true"></i>Quản lý người dùng
                            </a>
                            @endcan
                            @can('view-statistics')
                            <a href="{{ route('statistics') ?? '#' }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-chart-bar me-2" aria-hidden="true"></i>Thống kê
                            </a>
                            @endcan
                        </div>
                    </nav>
                    
                    <!-- Recent Posts Section -->
                    @isset($recentPosts)
                    <div class="mt-4">
                        <h6 class="text-muted fw-bold">Bài viết gần đây</h6>
                        <div class="list-group" role="list">
                            @forelse($recentPosts as $recentPost)
                                <a href="{{ route('posts.show', $recentPost->id) }}" 
                                   class="list-group-item list-group-item-action small recent-posts-item border-0 px-2 py-3"
                                   role="listitem">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold">{{ Str::limit($recentPost->title, 30) }}</h6>
                                            @if($recentPost->excerpt)
                                                <p class="mb-1 text-muted small">{{ Str::limit($recentPost->excerpt, 50) }}</p>
                                            @endif
                                        </div>
                                        <small class="text-muted ms-2">{{ $recentPost->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            @empty
                                <div class="text-muted small">Chưa có bài viết nào</div>
                            @endforelse
                        </div>
                    </div>
                    @endisset
                </div>
                
                <!-- Content -->
                <div class="col-md-9 col-lg-10 main-content" role="main">
                    <div class="container-fluid mt-4">
                        <!-- Breadcrumb -->
                        @hasSection('breadcrumb-items')
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('posts.index') }}" class="text-decoration-none">
                                        <i class="fas fa-home me-1" aria-hidden="true"></i>Trang chủ
                                    </a>
                                </li>
                                @yield('breadcrumb-items')
                            </ol>
                        </nav>
                        @endif
                        
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2" aria-hidden="true"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2" aria-hidden="true"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                            </div>
                        @endif
                        
                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i>
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                            </div>
                        @endif
                        
                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                                {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                            </div>
                        @endif
                        
                        <!-- Validation Errors -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2" aria-hidden="true"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                            </div>
                        @endif
                        
                        <!-- Page Header -->
                        @hasSection('page-title')
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="mb-1 fw-bold">@yield('page-title')</h2>
                                @hasSection('page-subtitle')
                                    <p class="text-muted mb-0">@yield('page-subtitle')</p>
                                @endif
                            </div>
                            <div>
                                @yield('page-actions')
                            </div>
                        </div>
                        @endif
                        
                        <!-- Main Content -->
                        <div class="row">
                            <div class="col-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-auto" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} My Blog. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <i class="fas fa-code" aria-hidden="true"></i> Made with 
                        <span class="text-danger">❤</span> using Laravel
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set up CSRF token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
            }
            
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert:not([data-persistent])');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert.parentNode) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
            
            // Loading state for forms
            const forms = document.querySelectorAll('form[data-loading]');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
                    }
                    this.classList.add('loading');
                });
            });
            
            // Smooth scroll for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
            
            // Back to top button (if exists)
            const backToTopBtn = document.getElementById('back-to-top');
            if (backToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopBtn.style.display = 'block';
                    } else {
                        backToTopBtn.style.display = 'none';
                    }
                });
                
                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialize popovers
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });
        
        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.error);
            // You can add error reporting service here
        });
    </script>
    
    @stack('scripts')
    @yield('scripts')
</body>
</html>