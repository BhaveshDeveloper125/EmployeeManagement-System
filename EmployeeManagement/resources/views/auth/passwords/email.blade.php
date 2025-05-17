@extends('layouts.app')

@section('content')
<div class="password-reset-container">
    <div class="password-reset-wrapper">
        <!-- Left decorative panel -->
        <div class="password-reset-decoration">
            <div class="decoration-overlay">
                <div class="brand-showcase">
                    <h2>Reset Your Password</h2>
                    <p>Enter your email to receive a secure reset link</p>
                    <div class="decoration-line"></div>
                </div>
                <div class="decoration-pattern">
                    <div class="pattern-circle gold"></div>
                    <div class="pattern-circle navy"></div>
                    <div class="pattern-circle red"></div>
                </div>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="password-reset-form-container">
            <div class="password-reset-form-wrapper">
                <div class="password-reset-header">
                    <div class="logo-container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#111F4D" width="36" height="36">
                            <path d="M12 2L4 8v12h16V8L12 2zm0 2.5L18 8v10H6V8l6-5.5zM12 15a3 3 0 110-6 3 3 0 010 6z" />
                        </svg>
                        <h1>Account Recovery</h1>
                    </div>
                    <p>Enter your registered email address below</p>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="password-reset-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <div class="input-with-icon">

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="your@email.com">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="submit-button">
                        {{ __('Send Reset Link') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" />
                        </svg>
                    </button>

                    <div class="back-to-login">
                        <a href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#111F4D" stroke-width="2">
                                <path d="M19 12H5M12 19l-7-7 7-7" />
                            </svg>
                            Return to login
                        </a>
                    </div>
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
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --gradient-primary: linear-gradient(135deg, #111F4D 0%, #0A142F 100%);
        --gradient-accent: linear-gradient(135deg, #FFD700 0%, #F4B400 100%);
        --input-focus: 0 0 0 3px rgba(17, 31, 77, 0.2);
    }

    .password-reset-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: var(--light-gray);
        padding: 2rem;
    }

    .password-reset-wrapper {
        display: flex;
        max-width: 1000px;
        width: 100%;
        background-color: var(--soft-white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .password-reset-decoration {
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
        font-size: 2.2rem;
        margin-bottom: 1rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .brand-showcase p {
        opacity: 0.9;
        margin-bottom: 2rem;
        font-size: 1rem;
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
        width: 250px;
        height: 250px;
        background-color: var(--gold-accent);
        top: -80px;
        right: -80px;
    }

    .pattern-circle.navy {
        width: 180px;
        height: 180px;
        background-color: var(--navy-blue);
        bottom: -40px;
        left: -40px;
    }

    .pattern-circle.red {
        width: 120px;
        height: 120px;
        background-color: var(--vibrant-red);
        top: 60%;
        left: 30%;
    }

    .password-reset-form-container {
        flex: 1;
        padding: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .password-reset-form-wrapper {
        max-width: 400px;
        width: 100%;
    }

    .password-reset-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .logo-container h1 {
        font-size: 1.8rem;
        color: var(--navy-blue);
        margin-left: 0.75rem;
        font-weight: 700;
    }

    .password-reset-header p {
        color: #6B7280;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--navy-blue);
        font-weight: 500;
        font-size: 0.95rem;
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
        box-shadow: var(--input-focus);
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

    .submit-button {
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
        margin-top: 1.5rem;
    }

    .submit-button:hover {
        background: var(--dark-navy);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(17, 31, 77, 0.25);
    }

    .submit-button svg {
        transition: var(--transition);
    }

    .submit-button:hover svg {
        transform: translateX(4px);
    }

    .back-to-login {
        margin-top: 1.5rem;
        text-align: center;
    }

    .back-to-login a {
        color: var(--navy-blue);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .back-to-login a:hover {
        color: var(--vibrant-red);
    }

    .back-to-login svg {
        transition: var(--transition);
    }

    .back-to-login a:hover svg {
        transform: translateX(-4px);
    }

    .alert-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success-green);
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--success-green);
        font-size: 0.9rem;
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .password-reset-wrapper {
            flex-direction: column;
        }

        .password-reset-decoration {
            padding: 2rem;
            text-align: center;
        }

        .brand-showcase h2 {
            font-size: 1.8rem;
        }

        .password-reset-form-container {
            padding: 2rem;
        }
    }

    @media (max-width: 576px) {
        .password-reset-container {
            padding: 1rem;
        }

        .password-reset-decoration {
            padding: 1.5rem;
        }

        .password-reset-form-container {
            padding: 1.5rem;
        }

        .logo-container {
            flex-direction: column;
        }

        .logo-container h1 {
            margin-left: 0;
            margin-top: 0.5rem;
        }
    }
</style>