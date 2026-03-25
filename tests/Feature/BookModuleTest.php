<?php

namespace Tests\Feature;

use App\Events\BookCreated;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BookModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a book can be created and has a UUID.
     */
    public function test_book_creation_uses_uuid()
    {
        $book = Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
        ]);

        $this->assertIsString($book->id);
        $this->assertEquals(36, strlen($book->id)); // UUID length
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Test Book',
        ]);
    }

    /**
     * Test that creating a book dispatches the BookCreated event.
     */
    public function test_book_creation_dispatches_event()
    {
        $user = User::factory()->create();
        Event::fake([
            BookCreated::class,
        ]);

        $response = $this->actingAs($user)->post(route('books.store'), [
            'title' => 'Event Test Book',
            'author' => 'Event Test Author',
        ]);

        $response->assertRedirect(route('books.index'));

        Event::assertDispatched(BookCreated::class, function ($event) {
            return $event->book->title === 'Event Test Book';
        });
    }
}
