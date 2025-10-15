@extends('layouts.app')

@section('content')
    <div class="item-show">
        <div class="item-show__container">
            <div class="item-show__gallery">
                <img src="{{ optional($item->images->sortBy('sort_order')->first())->path ?? asset('images/placeholder.png') }}"
                    alt="{{ $item->title }}">
            </div>
            <div class="item-show__panel">
                <h1 class="item-show__title">{{ $item->title }}</h1>
                <p class="item-show__brand">
                    <span>{{ $item->brand ?? '未設定' }}</span>
                </p>
                <p class="item-show__price">
                    ￥{{ number_format($item->price) }}
                    <small>（税込）</small>
                </p>

                {{-- いいねとコメント --}}
                <div class="item-show__meta">
                    <span class="pill">☆{{ $item->favorites_count ?? 0 }}</span>
                    <span class="pill">💬{{ $item->comments_count ?? 0 }}</span>
                </div>

                {{-- 購入ボタン --}}
                <a href="{{ route('orders.purchase', $item->id) }}" class="item-show__buy-button">購入手続きへ</a>

                <h2 class="item-show__section">商品説明</h2>
                <p class="item-show__description">{{ $item->description }}</p>
                <h2 class="item-show__section">商品の情報</h2>
                <dl class="item-show__specification">
                    <dt>カテゴリー</dt>
                    <dd>
                        @forelse($item->categories as $cat)
                            <span class="badge">{{ $cat->name }}</span>
                        @empty
                            <span class="muted">未設定</span>
                        @endforelse
                    </dd>
                    <dt>商品の状態</dt>
                    <dd>{{ $item->condition->label ?? '未設定' }}</dd>
                </dl>

                {{-- コメント欄 --}}
                <h2 class="item-show__section">コメント({{ $item->comments_count ?? 0 }})</h2>
                <ul class="item-show__comments">
                    @forelse ($item->comments as $c)
                        <li class="comment">
                            <div class="avatar"></div>
                            <div class="body">
                                <div class="author">{{ $c->user->name }}</div>
                                <div class="text">{{ $c->body }}</div>
                            </div>
                        </li>
                    @empty
                        <li class="muted">まだコメントはありません。</li>
                    @endforelse
                </ul>

                @auth
                    <form action="{{ route('comments.store', $item) }}" method="POST" novalidate>
                        @csrf
                        <h3 class="item-show__comment-title">商品へのコメント</h3>
                        <textarea name="body" maxlength="255">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="error" style="color:
                            red;">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="item-show__comment-submit">
                            コメントを投稿</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection
