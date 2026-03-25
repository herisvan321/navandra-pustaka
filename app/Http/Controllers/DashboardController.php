<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\WritingEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_events' => WritingEvent::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_testimonials' => Testimonial::count(),
            'total_news' => News::count(),
            'active_packages' => Package::count(),
        ];

        $latest_books = Book::latest()->take(5)->get();
        $latest_messages = ContactMessage::latest()->take(5)->get();
        $latest_news = News::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'latest_books', 'latest_messages', 'latest_news'));
    }
}
