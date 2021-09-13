<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('news.order');
    }

    public function doOrder()
    {
        return redirect('news')->with('status', 'Заказ успешно оформлен! В ближайшее время наш менеджер свяжется с вами.');
    }
}
