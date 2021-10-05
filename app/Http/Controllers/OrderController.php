<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderCreateRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('news.order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(OrderCreateRequest $request)
    {
        $order = Order::create(
            $request->only(['customerName', 'phone', 'email', 'description'])
        );

        if( $order ) {
            return redirect()
                ->route('news')
                ->with('success', __('messages.admin.order.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.order.create.fail'))
            ->withInput();
    }
}
