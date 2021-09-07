<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('news.categories', [
            'categoriesList' => $this->getCategories(),
        ]);
    }
    public function showFiltered(int $category_id)
    {
        return view('news.index', [
            'newsList' => $this->filterNews($category_id),
            'categoriesList' => $this->categoriesList
        ]);
    }
}
