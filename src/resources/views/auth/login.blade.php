@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login-page">
        <div class="login-card">
            <aside class="brand-aside">
                <div class="brand-bar">
                </div>
            </aside>
            <div class="form-pane">
                <h1 class="form-title">
                    ログイン</h1>


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input">
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">パスワード</label>
                        <input id="password" name="password" type="password" class="form-input">
                        @error('password')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>


                    <button type="submit" class="submit-button">ログインする</button>
                </form>

                <p class="register-link">
                    <a href="{{ route('register.show') }}">会員登録はこちら</a>
                </p>
            </div>
        </div>
    </div>
@endsection
