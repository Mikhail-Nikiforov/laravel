<?php

namespace App\Http\Controllers\Admin;

use App\Contract\Parser;
use App\Http\Controllers\Controller;
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
        return $service->parse('https://news.yandex.ru/music.rss');
    }
}
