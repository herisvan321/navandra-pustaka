<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\News;
use App\Models\WritingEvent;
use App\Models\ContactMessage;
use App\Models\User;

class DashboardRepository
{
    public function getStats(): array
    {
        return [
            'total_books' => Book::count(),
            'total_news' => News::count(),
            'active_events' => WritingEvent::where('is_active', true)->count(),
            'unread_messages' => ContactMessage::count(), // Assuming all are unread for now
            'total_users' => User::count(),
        ];
    }
}
