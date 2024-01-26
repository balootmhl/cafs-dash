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
        $categories = Category::whereNull('parent_id')->get();

        return view('events.index', compact('events', 'categories'));
    }

    public function search(Request $request)
    {
        $selected_main = Category::findOrFail($request->main_category);
        $selected_sub = Category::findOrFail($request->sub_category);
        $events = Event::where('category_id', $selected_sub->id)->get();
        $categories = Category::whereNull('parent_id')->get();
        return view('events.search-result', compact('events', 'categories', 'selected_sub', 'selected_main'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

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

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();


        return view('events.edit', compact('event', 'categories'));
    }

    public function update($id, Request $request)
    {
        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->datetime = $request->datetime;
        $event->category_id = $request->sub_category;
        $event->description = $request->description;
        $event->save();
        Alert::success('Success', 'Event updated.');
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
