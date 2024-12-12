<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 3;
        $page = $request->query('page', 1);
        $events = Event::paginate($perPage, ['*'], 'page', $page);
        return view('all-events', compact('events'));
    }
}
