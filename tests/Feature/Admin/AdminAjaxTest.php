<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Book;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAjaxTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin user
        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    /**
     * Test AJAX GET book details with UUID.
     */
    public function test_can_get_book_details_via_ajax_with_uuid()
    {
        $book = Book::create([
            'title' => 'Ajax Book',
            'author' => 'Ajax Author',
        ]);

        $response = $this->actingAs($this->admin)
                         ->getJson("/admin/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $book->id)
                 ->assertJsonPath('title', 'Ajax Book');
    }

    /**
     * Test AJAX GET news details with UUID.
     */
    public function test_can_get_news_details_via_ajax_with_uuid()
    {
        $news = News::create([
            'title' => 'Ajax News',
            'content' => 'Ajax Content',
            'status' => 'published',
        ]);

        $response = $this->actingAs($this->admin)
                         ->getJson("/admin/news/{$news->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $news->id)
                 ->assertJsonPath('title', 'Ajax News');
    }

    /**
     * Test AJAX delete book with UUID.
     */
    public function test_can_update_book_with_valid_status()
    {
        $book = Book::factory()->create();
        
        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.books.update', $book->id), [
                '_method' => 'PUT',
                'title' => 'Updated Book Title',
                'author' => 'Updated Author',
                'status' => 'available', // The value that was causing 422
                'price' => 150000,
            ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
            
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 'available'
        ]);
    }

    public function test_can_delete_book_via_ajax_with_uuid()
    {
        $book = Book::create([
            'title' => 'Delete Me',
            'author' => 'Author',
        ]);

        $response = $this->actingAs($this->admin)
                         ->deleteJson("/admin/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
