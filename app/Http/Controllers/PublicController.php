<?php

namespace App\Http\Controllers;

use App\Events\ContactMessageCreated;
use App\Models\Book;
use App\Models\CompanyProfile;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Package;
use App\Models\PublishingStep;
use App\Models\Testimonial;
use App\Models\WritingEvent;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $news = News::where('is_published', true)->latest()->take(3)->get();
        $books = Book::latest()->take(4)->get();
        $events = WritingEvent::where('is_active', true)->latest()->take(3)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(3)->get();
        $profile = CompanyProfile::first();

        return view('public.home', compact('news', 'books', 'events', 'testimonials', 'profile'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();

        return view('public.faq', compact('faqs'));
    }

    public function packages()
    {
        $packages = Package::orderBy('order')->get();

        return view('public.packages', compact('packages'));
    }

    public function publishingSteps()
    {
        $steps = PublishingStep::orderBy('order')->get();

        return view('public.steps', compact('steps'));
    }

    public function books()
    {
        $books = Book::latest()->paginate(12);

        return view('public.books', compact('books'));
    }

    public function bookDetail($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $relatedBooks = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('public.book-detail', compact('book', 'relatedBooks'));
    }

    public function about()
    {
        $profile = CompanyProfile::first();

        return view('public.about', compact('profile'));
    }

    public function contact()
    {
        $profile = CompanyProfile::first();

        return view('public.contact', compact('profile'));
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($validated);

        event(new ContactMessageCreated($message));

        return back()->with('success', 'Pesan Anda telah terkirim. Terima kasih!');
    }

    public function events()
    {
        $events = WritingEvent::where('is_active', true)->latest()->paginate(9);

        return view('public.events', compact('events'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('public.gallery', compact('galleries'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_active', true)->latest()->paginate(12);

        return view('public.testimonials', compact('testimonials'));
    }

    public function documentation()
    {
        $news = News::where('is_published', true)->latest()->paginate(10);

        return view('public.documentation', compact('news'));
    }
}
