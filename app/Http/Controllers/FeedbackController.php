<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        $feedback = Feedback::create(
            $request->only(['customerName', 'description'])
        );

        if( $feedback ) {
            return redirect()
                ->route('news')
                ->with('success', 'Отзыв успешно оставлен!');
        }

        return back()
            ->with('error', 'Не удалось оформить заказ')
            ->withInput();
    }
}
