<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //商品一覧
    public function index()
    {
        $items = Item::query()
            ->select('items.*')
            ->selectSub(function ($q) {
                $q->from('item_images')
                    ->select('path')
                    ->whereColumn(
                        'item_images.item_id',
                        'items.id'
                    )
                    ->orderByRaw('sort_order IS NULL, sort_order ASC, id ASC')
                    ->limit(1);
            }, 'thumb')
            ->orderBy('items.id')
            ->paginate(8);
        return view(
            'items.index',
            compact('items')
        );
    }

    public function search(Request $request)
    {
        $keyword = trim(mb_convert_kana($request->input('keyword', ''), 's'));

        // 部分一致
        $items = Item::query()
            ->when($keyword !== '', function ($q)
            use ($keyword) {
                $q->where(function ($qq) use ($keyword) {
                    $qq->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhere('description', 'LIKE', "%{$keyword}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view(
            'items.index',
            compact('items', 'keyword')
        );
    }


    public function show($item_id)
    {
        $item = \App\Models\Item::with([
            'images' => fn($q) => $q->orderBy('sort_order'),
            'categories',
            'comments.user',
            'favorites',
        ])
            ->withCount([
                'favorites as favorites_count',
                'comments as comments_count',
            ])
            ->findOrFail($item_id);
        $isFavorited = auth()->check() ?
            $item->favorites()->where('user_id', auth()->id())->exists()
            : false;
        return view('items.show', compact('item', 'isFavorited'));
    }

    public function create()
    {
        $categories =
            Category::orderBy('id')->get(['id', 'name']);
        return view('items.create', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $user = Auth::user();
        $item = Item::create([
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'brand' => $request->brand ?? null,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
            'status' => 'listed',
            'stock' => 1,
        ]);

        $path =
            $request->file('image')->store('items', 'public');

        ItemImage::create([
            'item_id' => $item->id,
            'file_path' => $path,
        ]);

        return redirect()->route('items.show', $item);
    }
}
