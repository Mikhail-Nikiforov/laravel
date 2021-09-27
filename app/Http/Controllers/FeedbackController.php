<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\FeedbackCreateRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */


    public function store(FeedbackCreateRequest $request)
    {
        $feedback = Feedback::create(
            $request->only(['customerName', 'description'])
        );

        if( $feedback ) {
            return redirect()
                ->route('news')
                ->with('success', __('messages.admin.feedback.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.feedback.create.fail'))
            ->withInput();
    }
}
