@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>購入確認</h1>
        <p>商品名:{{ $item->title }}</p>
        <p>価格:{{ $item->price }}円</p>

        <form method="POST" action="#">
            @csrf
            <button type="submit" class="button button-success">購入を確定する</button>
        </form>
    </div>
@endsection
