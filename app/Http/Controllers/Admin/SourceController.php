<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceCreateRequest;
use App\Http\Requests\SourceUpdateRequest;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::withCount('news')
            ->orderBy('created_at', 'desc')
            ->paginate(config('admin.paginate'));

        return view('admin.sources.index', [
            'sources' => $sources
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SourceCreateRequest $request)
    {
        $request->validate([
            'name_source' => ['required', 'string', 'min:3']
        ]);

        $source = Source::create(
            $request->only(['name_source','description'])
        );

        if( $source ) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', __('messages.admin.source.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.source.create.fail'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Source $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('admin.sources.edit', [
            'source' => $source
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SourceUpdateRequest $request, Source $source)
    {
        $source = $source->fill(
            $request->only(['name_source', 'description'])
        )->save();

        if($source) {
            return redirect()
                ->route('admin.sources.index')
                ->with('success', __('messages.admin.source.update.success'));
        }

        return back()
            ->with('error', __('messages.admin.source.update.fail'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Source $source)
    {
        if($request->ajax()) {
            try {
                $source->delete();
                return response()->json(['message' => 'ok']);

            } catch (\Exception $e) {
                \Log::error("Error delete news" . PHP_EOL, [$e]);
                return response()->json(['message' => 'error'], 400);
            }
        }
    }
}
