<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    public function store(Request $request)
    {

        $order = Order::create(
            $request->only(['customerName', 'phone', 'email', 'description'])
        );

        if( $order ) {
            return redirect()
                ->route('news')
                ->with('success', 'Заказ успешно оформлен! В ближайшее время наш менеджер свяжется с вами.');
        }

        return back()
            ->with('error', 'Не удалось оформить заказ')
            ->withInput();
    }
}
