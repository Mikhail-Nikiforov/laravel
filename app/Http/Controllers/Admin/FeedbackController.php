<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackCreateRequest;
use App\Http\Requests\FeedbackUpdateRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbackList = Feedback::paginate(
                config('news.paginate')
            );

        return view('admin.feedback.index', [
            'feedbackList' => $feedbackList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.feedback.create');
    }

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
                ->route('admin.feedback.index')
                ->with('success', __('messages.admin.feedback.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.feedback.create.fail'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedback.edit', [
            'feedback' => $feedback
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FeedbackUpdateRequest $request, Feedback $feedback)
    {

        $feedback = $feedback->fill(
            $request->only(['customerName', 'description'])
        )->save();

        if( $feedback ) {
            return redirect()
                ->route('admin.feedback.index')
                ->with('success', __('messages.admin.feedback.update.success'));
        }

        return back()
            ->with('error', __('messages.admin.feedback.update.fail'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Feedback $feedback)
    {
        if($request->ajax()) {
            try {
                $feedback->delete();
                return response()->json(['message' => 'ok']);

            } catch (\Exception $e) {
                \Log::error("Error delete news" . PHP_EOL, [$e]);
                return response()->json(['message' => 'error'], 400);
            }
        }
    }
}


