<?php

namespace App\Http\Controllers;

use App\Events\PublishingStepCreated;
use App\Models\PublishingStep;
use Illuminate\Http\Request;

class PublishingStepController extends Controller
{
    public function index()
    {
        $steps = PublishingStep::orderBy('order')->get();

        return view('steps.index', compact('steps'));
    }

    public function create()
    {
        return view('steps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'icon' => 'nullable|string',
        ]);

        $step = PublishingStep::create($validated);

        event(new PublishingStepCreated($step));

        return redirect()->route('publishing-steps.index')
            ->with('success', 'Langkah penerbitan berhasil ditambahkan.');
    }

    public function edit(PublishingStep $publishingStep)
    {
        return view('steps.edit', ['step' => $publishingStep]);
    }

    public function update(Request $request, PublishingStep $publishingStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'icon' => 'nullable|string',
        ]);

        $publishingStep->update($validated);

        return redirect()->route('publishing-steps.index')
            ->with('success', 'Langkah penerbitan berhasil diperbarui.');
    }

    public function destroy(PublishingStep $publishingStep)
    {
        $publishingStep->delete();

        return redirect()->route('publishing-steps.index')
            ->with('success', 'Langkah penerbitan berhasil dihapus.');
    }
}
