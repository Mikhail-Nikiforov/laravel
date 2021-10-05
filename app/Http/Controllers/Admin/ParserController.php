<?php

namespace App\Http\Controllers\Admin;

use App\Contract\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsJob;
use App\Models\Resource;
use Illuminate\Http\Request;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Parser $service)
    {
        $urls = Resource::all();

        foreach ($urls as $url) {
            dispatch(new NewsJob($url->link));
        }
        return back()->with('success', 'Новости добавлены в очередь');
    }
}
