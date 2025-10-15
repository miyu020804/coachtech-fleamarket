@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('content')
    <div class="verify-page">
        <p class="lead">登録されたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        @if (session('status') === 'verification-link-sent')
            <p class="sent">認証メールを再送しました。</p>
        @endif

        <div class="actions">
            <div class="direct-verify">
                @auth
                    @php
                        /** @var \App\Models\User $user */
                        $user = auth()->user();
                        $directVerifyUrl = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                            'verification.verify',
                            now()->addMinutes(60), // 有効期限
                            ['id' => $user->getKey(), 'hash' => sha1($user->getEmailForVerification())],
                        );
                    @endphp
                    <a href="{{ $directVerifyUrl }}" class="button-resend">認証はこちらから</a>
                @endauth
            </div>


            <form method="POST" action="{{ route('verification.send') }}" class="resend-form">
                @csrf
                <button type="submit" class="link-resend">認証メールを再送する</button>
            </form>
        @endsection
