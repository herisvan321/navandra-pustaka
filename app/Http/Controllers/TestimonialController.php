<?php

namespace App\Http\Controllers;

use App\Events\TestimonialCreated;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);

        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:100',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $testimonial = Testimonial::create($validated);

        event(new TestimonialCreated($testimonial));

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:100',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $testimonial->update($validated);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
