<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceCreateRequest;
use App\Http\Requests\ResourceUpdateRequest;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::query()
            ->paginate(config('admin.paginate'));

        return view('admin.resources.index', [
            'resources' => $resources
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceCreateRequest $request)
    {
        $resource = Resource::create(
            $request->only(['title', 'link', 'description'])
        );

        if( $resource ) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', __('messages.admin.resource.create.success'));
        }

        return back()
            ->with('error', __('messages.admin.resource.create.fail'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', [
            'resource' => $resource
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ResourceUpdateRequest $request, Resource $resource)
    {
        $resource = $resource->fill(
            $request->only(['title', 'link', 'description'])
        )->save();

        if($resource) {
            return redirect()
                ->route('admin.resources.index')
                ->with('success', __('messages.admin.resource.update.success'));
        }

        return back()
            ->with('error', __('messages.admin.resource.update.fail'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Resource $resource)
    {
        if($request->ajax()) {
            try {
                $resource->delete();
                return response()->json(['message' => 'ok']);

            } catch (\Exception $e) {
                \Log::error("Error delete news" . PHP_EOL, [$e]);
                return response()->json(['message' => 'error'], 400);
            }
        }
    }
}
