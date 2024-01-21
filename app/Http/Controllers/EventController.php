<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        $title = 'Delete Event!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->datetime = $request->datetime;
        $event->category_id = $request->sub_category;
        $event->description = $request->description;
        $event->save();
        Alert::success('Success', 'Event created.');
        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        Alert::success('Success', 'Event deleted.');

        return redirect()->route('events.index');
    }
}
