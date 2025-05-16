@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-wrapper">
        <!-- Left decorative panel -->
        <div class="login-decoration">
            <div class="decoration-overlay">
                <div class="brand-showcase">
                    <h2>Welcome Back</h2>
                    <p>Access your account and continue your journey with us</p>
                    <div class="decoration-line"></div>
                </div>
                <div class="decoration-pattern">
                    <div class="pattern-circle gold"></div>
                    <div class="pattern-circle navy"></div>
                    <div class="pattern-circle red"></div>
                </div>
            </div>
        </div>

        <!-- Right login form -->
        <div class="login-form-container">
            <div class="login-form-wrapper">
                <div class="login-header">
                    <h1>Sign In</h1>
                    <p>Enter your credentials to access your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <div class="input-with-icon">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111F4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg> -->
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <div class="input-with-icon">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111F4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg> -->
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                        @endif
                    </div>

                    <button type="submit" class="login-button">
                        {{ __('Login') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    :root {
        --navy-blue: #111F4D;
        --light-gray: #F2F4F7;
        --vibrant-red: #E43A19;
        --deep-black: #020205;
        --gold-accent: #FFD700;
        --soft-white: #FFFFFF;
        --success-green: #10B981;
        --dark-navy: #0A142F;
        --light-blue: #E6F0FF;
        --sidebar-width: 280px;
        --sidebar-collapsed: 80px;
        --header-height: 80px;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --gradient-primary: linear-gradient(135deg, #111F4D 0%, #0A142F 100%);
        --gradient-accent: linear-gradient(135deg, #FFD700 0%, #F4B400 100%);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--light-gray);
        color: var(--deep-black);
        line-height: 1.6;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
    }

    .login-wrapper {
        display: flex;
        max-width: 1200px;
        width: 100%;
        background-color: var(--soft-white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .login-decoration {
        flex: 1;
        background: var(--gradient-primary);
        position: relative;
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: var(--soft-white);
    }

    .decoration-overlay {
        position: relative;
        z-index: 2;
    }

    .brand-showcase h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .brand-showcase p {
        opacity: 0.9;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .decoration-line {
        height: 4px;
        width: 80px;
        background: var(--gradient-accent);
        margin: 2rem 0;
        border-radius: 2px;
    }

    .decoration-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .pattern-circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
    }

    .pattern-circle.gold {
        width: 300px;
        height: 300px;
        background-color: var(--gold-accent);
        top: -100px;
        right: -100px;
    }

    .pattern-circle.navy {
        width: 200px;
        height: 200px;
        background-color: var(--navy-blue);
        bottom: -50px;
        left: -50px;
    }

    .pattern-circle.red {
        width: 150px;
        height: 150px;
        background-color: var(--vibrant-red);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .login-form-container {
        flex: 1;
        padding: 4rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-form-wrapper {
        max-width: 400px;
        width: 100%;
    }

    .login-header h1 {
        font-size: 2rem;
        color: var(--navy-blue);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .login-header p {
        color: #6B7280;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--navy-blue);
        font-weight: 500;
    }

    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-with-icon svg {
        position: absolute;
        left: 15px;
        z-index: 2;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--soft-white);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--navy-blue);
        box-shadow: 0 0 0 3px rgba(17, 31, 77, 0.1);
    }

    .form-control::placeholder {
        color: #9CA3AF;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        color: var(--vibrant-red);
        font-size: 0.875rem;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input {
        margin-right: 0.5rem;
        width: 16px;
        height: 16px;
        accent-color: var(--navy-blue);
    }

    .remember-me label {
        color: #6B7280;
        font-size: 0.875rem;
    }

    .forgot-password {
        color: var(--navy-blue);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .forgot-password:hover {
        color: var(--vibrant-red);
        text-decoration: underline;
    }

    .login-button {
        width: 100%;
        padding: 1rem;
        background: var(--gradient-primary);
        color: var(--soft-white);
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .login-button:hover {
        background: var(--dark-navy);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(17, 31, 77, 0.2);
    }

    .login-button svg {
        transition: var(--transition);
    }

    .login-button:hover svg {
        transform: translateX(4px);
    }

    .login-footer {
        margin-top: 1.5rem;
        text-align: center;
        color: #6B7280;
        font-size: 0.875rem;
    }

    .login-footer a {
        color: var(--navy-blue);
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .login-footer a:hover {
        color: var(--vibrant-red);
        text-decoration: underline;
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .login-wrapper {
            flex-direction: column;
        }

        .login-decoration {
            padding: 2rem;
            text-align: center;
        }

        .brand-showcase h2 {
            font-size: 2rem;
        }

        .login-form-container {
            padding: 2rem;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 1rem;
        }

        .login-decoration {
            padding: 1.5rem;
        }

        .login-form-container {
            padding: 1.5rem;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .forgot-password {
            margin-top: 0.5rem;
        }
    }
</style>