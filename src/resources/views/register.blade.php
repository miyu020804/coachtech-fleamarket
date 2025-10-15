@extends('layouts.app')

@section('title', '会員登録')

@section('content')
    <div class="page-container">
        <div class=" mx-auto w-full max-w-sm px-4">
            <h1 class="register-title">会員登録</h1>


            <form method="POST" action="{{ route('register.store') }}" class="space-y-4" novalidate>
                @csrf
                <div>
                    <label class="block text-sm mb-1" for="name">ユーザー名</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                        class="w-full border border-gray-500 rounded p-2">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-1" for="email">メールアドレス</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        class="w-full border border-gray-500 rounded p-2">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-1" for="password">パスワード</label>
                    <input id="password" name="password" type="password" class="w-full border border-gray-500 rounded p-2">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-1" for="password_confirmation">確認用パスワード</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        class="w-full border border-gray-500 rounded p-2">
                </div>
                <button type="submit" class="w-full h-11 rounded bg-red-500 text-white font-medium">登録する</button>
            </form>
            <p class="login-link-wrap">
                <a href="{{ route('login') }}" class="login-link">ログインはこちら</a>
            </p>
        </div>
    </div>
@endsection
