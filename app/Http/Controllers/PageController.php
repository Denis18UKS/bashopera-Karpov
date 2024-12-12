<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\News;

class PageController extends Controller
{
    public function index()
    {
        $currentMonthEvents = Event::where('show_date', '>=', Carbon::now()->startOfMonth())
            ->where('show_date', '<', Carbon::now()->endOfMonth()->addDay())
            ->orderBy('show_date', 'asc')
            ->take(3)
            ->get();

        $nexMonthEvents = Event::where('show_date', '>=', Carbon::now()->addMonth()->startOfMonth())
            ->where('show_date', '<', Carbon::now()->addMonth()->endOfMonth()->addDay())
            ->orderBy('show_date', 'asc')
            ->take(3 - $currentMonthEvents->count())
            ->get();

        $events = $currentMonthEvents->merge($nexMonthEvents);
        $latestNews = News::orderBy('created_at', 'desc')->take(4)->get();
        return view('index', compact('events', 'latestNews'));
    }
}
