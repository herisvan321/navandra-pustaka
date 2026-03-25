<?php

namespace App\Http\Controllers;

use App\Events\WritingEventCreated;
use App\Models\WritingEvent;
use Illuminate\Http\Request;

class WritingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = WritingEvent::latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'genre' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $event = WritingEvent::create($validated);

        event(new WritingEventCreated($event));

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WritingEvent $writingEvent)
    {
        return view('events.show', compact('writingEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WritingEvent $writingEvent)
    {
        return view('events.edit', ['event' => $writingEvent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WritingEvent $writingEvent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'genre' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $writingEvent->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WritingEvent $writingEvent)
    {
        $writingEvent->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
