<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        $sellingItems =
            Item::where('user_id', $user->id)->get();

        $boughtItemIds =
            Order::where('buyer_id', $user->id)->pluck('item_id');
        $boughtItems = Item::whereIn('id', $boughtItemIds)->get();

        $viewType = $request->query('type', 'selling');

        return view(
            'mypage.profile.mypage',
            compact(
                'user',
                'sellingItems',
                'boughtItems',
                'viewType'
            )
        );
    }
}
