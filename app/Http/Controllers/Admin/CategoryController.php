<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('news')
            ->paginate(
                config('news.paginate')
            );

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {

        $category = Category::create(
            $request->only(['title','description'])
        );

        if( $category ) {
            return redirect()
            ->route('admin.categories.index')
            ->with('success', __('messages.admin.category.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.category.create.fail'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category = $category->fill(
            $request->only(['title', 'description'])
        )->save();

        if($category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Запись успешно обновлена');
        }

        return back()
            ->with('error', 'Запись не была обновлена')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        if($request->ajax()) {
            try {
                $category->delete();
                return response()->json(['message' => 'ok']);

            } catch (\Exception $e) {
                \Log::error("Error delete news" . PHP_EOL, [$e]);
                return response()->json(['message' => 'error'], 400);
            }
        }
    }
}
