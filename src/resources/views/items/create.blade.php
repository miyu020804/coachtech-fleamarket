@extends('layouts.app')

@section('title', '商品の出品')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">

    <div class="container" style="max-width: 720px;margin:24px auto;">
        <h1 style="text-align: center;margin-bottom:24px;">商品の出品</h1>

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom: 16px;">
                <label>商品画像</label>
                <input type="file" name="image" accept="image/png,image/jpeg">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label>カテゴリー</label>
                <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id') }}">
                <div id="cat-buttons" style="display: flex;flex-wrap;gap:8px;margin-top:8px;">
                    @foreach ($categories as $cat)
                        <button type="button" class="cat-button {{ old('category_id') == $cat->id ? 'is-active' : '' }}"
                            data-id="{{ $cat->id }}">{{ $cat->name }}</button>
                    @endforeach
                </div>
                @error('category_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="condition">商品の状態</label>
                <select name="condition" id="condition" required>
                    <option value="">選択してください</option>
                    <option value="1" {{ old('condition') == 1 ? 'selected' : '' }}>良好</option>
                    <option value="2" {{ old('condition') == 2 ? 'selected' : '' }}>目立った傷や汚れなし</option>
                    <option value="3" {{ old('condition') == 3 ? 'selected' : '' }}>やや傷や汚れあり</option>
                    <option value="4" {{ old('condition') == 4 ? 'selected' : '' }}>状態が悪い</option>
                </select>
                @error('condition')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label>商品の説明</label>
                <textarea name="description" maxlength="255">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label>商品価格</label>
                <input type="number" name="price" min="0" value="{{ old('price') }}" />
                @error('price')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="button-primary" style="width:100%;">出品する</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.cat-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.cat-button').forEach(b => b.classList.remove('is-active'));
                button.classList.add('is-active');

                document.getElementById('category_id').value = button.dataset.id;
            });
        });
    </script>
@endsection
