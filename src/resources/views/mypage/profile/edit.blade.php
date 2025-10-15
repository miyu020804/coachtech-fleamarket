@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <h1 class="profile-title">プロフィール設定</h1>
    <div style="max-width:960px;margin:48px
auto;padding:24px;">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-grid">
            @csrf @method('PUT')
            <div class="profile-avatar">
                <img src="{{ $user->avatar_path ? asset('storage/' . $user->avatar_path) : asset('images/placeholder.png') }}"
                    alt="avatar">
                <label for="avatar" class="select-avatar-label">画像を選択する</label>
                <input id="avatarInput" type="file" name="avatar" accept="image/jpeg,image/png">
            </div>
            <label class="f-label">ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            <label>郵便番号</label>
            <input type="text" name="postal_code"
                value="{{ old('postal_code', optional($user->database)->postal_code) }}" required>
            <label>住所</label>
            <input type="text" name="address_line1"
                value="{{ old('address_line1', optional($user->address)->address_line1) }}" required>
            <label>建物名</label>
            <input type="text" name="address_line2"
                value="{{ old('address_line2', optional($user->address)->address_line2) }}" required>
            <button type="submit">更新する</button>
        </form>
        <script>
            document.getElementBy('avatarInput')?.addEventListener('change', e => {
                const [f] = e.target.files || [];
                if (!f)
                    return;
                document.getElementById('avatarPreview').src = URL.createObjectURL(f);
            });
        </script>
    @endsection
