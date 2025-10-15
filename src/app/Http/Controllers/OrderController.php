<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function purchase(Item $item)
    {
        return view(
            'orders.purchase',
            compact('item')
        );
    }
}
