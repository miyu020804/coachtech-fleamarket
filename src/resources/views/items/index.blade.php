@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="tabs">
            <button class="tab active">おすすめ</button>
            <button class="tab">マイリスト</button>
        </div>
        <div class="tabs-border"></div>
        <div class="items-grid">
            @if ($items->isEmpty())
                <p>「{{ $keyword }}」に一致する商品はありません。</p>
            @else
                @foreach ($items as $item)
                    <a href="{{ route('items.show', ['item' => $item->id]) }}" class="card">
                        <div class="thumb">
                            <img src="{{ $item->thumb ? asset('storage/' . $item->thumb) : asset('images/placeholder.png') }}"
                                alt="{{ $item->title }}">
                            <div class="name">{{ $item->title }}</div>
                            @if ($item->orders_count > 0)
                                <span class="sold-badge">Sold</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            @endif




            <div class="pager">
                @if ($items->onFirstPage())
                    <span class="pager-button disabled">前へ</span>
                @else
                    <a class="pager-button" href="{{ $items->previousPageUrl() }}">前へ</a>
                @endif
                <span class="pager-info">
                    ページ {{ $items->currentPage() }} /
                    {{ $items->lastPage() }}
                </span>

                @if ($items->hasMorePages())
                    <a class="pager-button" href="{{ $items->nextPageUrl() }}">次へ</a>
                @else
                    <span class="pager-button disabled">次へ</span>
                @endif
            </div>
        @endsection
