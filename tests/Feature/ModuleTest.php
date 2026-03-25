<?php

namespace Tests\Feature;

use App\Events\FaqCreated;
use App\Events\GalleryCreated;
use App\Events\PackageCreated;
use App\Events\PublishingStepCreated;
use App\Events\TestimonialCreated;
use App\Events\WritingEventCreated;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\PublishingStep;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WritingEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);
    }

    public function test_faq_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('faqs.store'), [
            'question' => 'What is Nevandra?',
            'answer' => 'A professional publishing house.',
            'order' => 1,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('faqs.index'));
        $this->assertDatabaseHas('faqs', ['question' => 'What is Nevandra?']);

        $faq = Faq::where('question', 'What is Nevandra?')->first();
        $this->assertIsString($faq->id);
        $this->assertEquals(36, strlen($faq->id)); // UUID length

        Event::assertDispatched(FaqCreated::class);
    }

    public function test_package_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('packages.store'), [
            'name' => 'Premium Package',
            'tagline' => 'The best choice',
            'price' => 5000000,
            'features' => ['ISBN', 'Hardcover'],
            'is_featured' => true,
            'order' => 1,
        ]);

        $response->assertRedirect(route('packages.index'));
        $this->assertDatabaseHas('packages', ['name' => 'Premium Package']);

        $package = Package::where('name', 'Premium Package')->first();
        $this->assertIsString($package->id);
        Event::assertDispatched(PackageCreated::class);
    }

    public function test_publishing_step_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('publishing-steps.store'), [
            'title' => 'Submit Manuscript',
            'description' => 'Send your work via email.',
            'order' => 1,
        ]);

        $response->assertRedirect(route('publishing-steps.index'));
        $this->assertDatabaseHas('publishing_steps', ['title' => 'Submit Manuscript']);

        $step = PublishingStep::where('title', 'Submit Manuscript')->first();
        $this->assertIsString($step->id);
        Event::assertDispatched(PublishingStepCreated::class);
    }

    public function test_gallery_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('gallery.store'), [
            'title' => 'Event A',
            'type' => 'gallery',
            'description' => 'Test description',
        ]);

        $response->assertRedirect(route('gallery.index'));
        $this->assertDatabaseHas('galleries', ['title' => 'Event A']);

        $gallery = Gallery::where('title', 'Event A')->first();
        $this->assertIsString($gallery->id);
        Event::assertDispatched(GalleryCreated::class);
    }

    public function test_testimonial_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('testimonials.store'), [
            'name' => 'John Doe',
            'role' => 'Author',
            'content' => 'Great service!',
            'rating' => 5,
        ]);

        $response->assertRedirect(route('testimonials.index'));
        $this->assertDatabaseHas('testimonials', ['name' => 'John Doe']);

        $testi = Testimonial::where('name', 'John Doe')->first();
        $this->assertIsString($testi->id);
        Event::assertDispatched(TestimonialCreated::class);
    }

    public function test_writing_event_module()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $response = $this->actingAs($this->admin)->post(route('events.store'), [
            'title' => 'Poetry Contest',
            'description' => 'Write about nature.',
            'deadline' => '2025-12-31',
            'is_active' => true,
            'type' => 'Umum',
            'genre' => 'Puisi',
        ]);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('writing_events', ['title' => 'Poetry Contest']);

        $event = WritingEvent::where('title', 'Poetry Contest')->first();
        $this->assertIsString($event->id);
        Event::assertDispatched(WritingEventCreated::class);
    }
}
