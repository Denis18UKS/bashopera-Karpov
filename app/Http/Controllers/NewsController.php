<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 3;
        $page = $request->query('page', 1);
        $news = News::paginate($perPage, ['*'], 'page', $page);
        return view('all-news', compact('news'));
    }
}
