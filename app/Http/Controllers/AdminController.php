<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\News;
use App\Models\AgeRegistration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function events()
    {
        $events = Event::with('ageRestriction')->get();
        return view('admin.events', compact('events'));
    }

    public function news()
    {
        $news = News::all();
        return view('admin.news', compact('news'));
    }

    public function createEvent(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'duration' => 'required|date_format:H:i:s',
            'id_age_restriction' => ['required', Rule::exists('age_registrations', 'id')],
            'description' => 'required|string',
            'team' => 'required|string',
            'image' => 'required|image|mimes:jpeg, png, jpg, gif|max:2048',
            'show_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $imagePath = $request->file('image')->store('events', 'public');
        $validatedData['image'] = $imagePath;

        Event::create($validatedData);
        return redirect()->route('admin.events')->with('success', 'Мероприятия добавлено');
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'duration' => 'required|date_format:H:i:s',
            'id_age_restriction' => ['required', Rule::exists('age_registrations', 'id')],
            'description' => 'required|string',
            'team' => 'required|string',
            'image' => 'required|image|mimes:jpeg, png, jpg, gif|max:2048',
            'show_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($event->image);
            $imagePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $imagePath;
        }


        $event->update($validatedData);
        return redirect()->route('admin.events')->with('success', 'Мероприятие обнавлено');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        Storage::disk('public')->delete($event->image);
        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Меропрриятие удалено');
    }







    public function createNews(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg, png, jpg, gif|max:2048',
            'created_at' => 'required|date_format:Y-m-d H:i:s',
            'updated_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $imagePath = $request->file('image')->store('news', 'public');
        $validatedData['image'] = $imagePath;

        Event::create($validatedData);
        return redirect()->route('admin.news')->with('success', 'Новость добавлена');
    }

    public function updateNews(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg, png, jpg, gif|max:2048',
            'created_at' => 'required|date_format:Y-m-d H:i:s',
            'updated_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($news->image);
            $imagePath = $request->file('image')->store('news', 'public');
            $validatedData['image'] = $imagePath;
        }


        $news->update($validatedData);
        return redirect()->route('admin.news')->with('success', 'Новость обновлена');
    }

    public function deleteNews($id)
    {
        $event = Event::findOrFail($id);
        Storage::disk('public')->delete($event->image);
        $event->delete();
        return redirect()->route('admin.news')->with('success', 'Новость удалена');
    }
}
