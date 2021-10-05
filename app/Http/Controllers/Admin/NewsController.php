<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Services\UploadService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsList = News::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(config('admin.paginate'));

        return view('admin.news.index', [
            'newsList' => $newsList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories =  Category::all();
        $sources =  Source::all();
        return view('admin.news.create', [
            'categories' => $categories,
            'sources' => $sources
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsCreateRequest $request)
    {

        $news = News::create($request->validated());

        if( $news ) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', __('messages.admin.news.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.news.create.fail'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories =  Category::all();
        $sources =  Source::all();

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'sources' => $sources
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $uploadService = app(UploadService::class);
            $fileUrl = $uploadService->upload($request->file('image'));
            $data['image'] = $fileUrl;
        }

        $news = $news->fill($data)->save();

        if( $news ) {
            return redirect()
                ->route('admin.news.index')
                ->with('success', __('messages.admin.news.update.success'));
        }

        return back()
            ->with('error', __('messages.admin.news.update.fail'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, News $news)
    {
        if($request->ajax()) {
            try {
                $news->delete();
                return response()->json(['message' => 'ok']);

            } catch (\Exception $e) {
                \Log::error("Error delete news" . PHP_EOL, [$e]);
                return response()->json(['message' => 'error'], 400);
            }
        }
    }
}
