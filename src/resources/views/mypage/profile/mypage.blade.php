@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="mypage-container">
        <div class="profile-header">
            <div class="profile-image">
                <img src="{{ asset('images/default-icon.png') }}" alt="プロフィール画像">
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <a href="{{ route('profile.edit') }}" class="edit-button">プロフィールを編集</a>
            </div>
        </div>

        <div class="mypage-tabs">
            <a href="?tab=selling" class="{{ request('tab') !== 'bought' ? 'active' : '' }}">購入した商品</a>
        </div>

        <div class="mypage-items">
            @if (request('tab') === 'bought')
                @foreach ($boughtItems as $item)
                    <div class="item-card">
                        <img src="{{ $item->image_path }}" alt="商品画像">
                        <p>{{ $item->name }}</p>
                    </div>
                @endforeach
            @else
                @foreach ($sellingItems as $item)
                    <div class="item-card">
                        <img src="{{ $item->image_path }}" alt="商品画像">
                        <p>{{ $item->name }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
