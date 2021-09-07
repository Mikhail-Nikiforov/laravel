<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'newsList' => $this->getNews(),
            'categoriesList' => $this->categoriesList
        ]);
    }

    public function show(int $id)
    {
        return view('news.show', [
            'news' => $this->getNews()[0],
        ]);
    }
}
