<?php

namespace App\Http\Controllers;

use App\Events\NewsEvent;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
	{
        event(new NewsEvent());

        $newsList = News::paginate(
            config('news.paginate')
        );

		return view('news.index', [
			'newsList' => $newsList,
		]);
	}

	public function show(int $id)
	{
		return view('news.show', [
			'id' => $id
		]);
	}

}
