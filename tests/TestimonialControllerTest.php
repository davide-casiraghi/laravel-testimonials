<?php

namespace DavideCasiraghi\LaravelTestimonials\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelTestimonials\Models\Testimonial;

class TestimonialControllerTest extends TestCase
{
    use WithFaker;

    /***************************************************************/

    /** @test */
    public function it_runs_the_test_testimonial_factory()
    {
        $testimonial = factory(Testimonial::class)->create([
                            'name' => 'test name',
                        ]);
        $this->assertDatabaseHas('testimonial_translations', [
                                'locale' => 'en',
                                'name' => 'test name',
                ]);
    }

    /** @test */
    public function it_displays_the_testimonials_index_page()
    {
        $this->authenticateAsAdmin();
        $this->get('testimonials')
            ->assertViewIs('laravel-testimonials::testimonials.index')
            ->assertStatus(200);
    }

    /** @test */
    public function it_displays_the_testimonial_create_page()
    {
        $this->authenticateAsAdmin();

        $this->get('testimonials/create')
            ->assertViewIs('laravel-testimonials::testimonials.create')
            ->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_valid_testimonial()
    {
        $this->authenticateAsAdmin();

        $data = [
            'name' => 'test title',
            'body' => 'test body',
            'profession' => 'test profession',
            'testimonials_group' => 1,
            'image_file_name' => 'image_test_1.jpg',
            'fontawesome_icon_class' => 'fa-hand-heart',
            'icon_color' => '#2365AA',
            'button_url' => 'http://www.google.it',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/testimonials', $data);

        $this->assertDatabaseHas('testimonials', ['image_file_name' => 'image_test_1.jpg']);
        $response->assertViewIs('laravel-testimonials::testimonials.index');
    }

    /** @test */
    public function it_does_not_store_invalid_testimonial()
    {
        $this->authenticateAsAdmin();
        $response = $this->post('/testimonials', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Testimonial::first());
    }

    /** @test */
    public function it_displays_the_testimonial_show_page()
    {
        $this->authenticate();

        $testimonial = factory(Testimonial::class)->create();
        $response = $this->get('/testimonials/'.$testimonial->id);
        $response->assertViewIs('laravel-testimonials::testimonials.show')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_displays_the_testimonial_edit_page()
    {
        $this->authenticateAsAdmin();

        $testimonial = factory(Testimonial::class)->create();
        $response = $this->get("/testimonials/{$testimonial->id}/edit");
        $response->assertViewIs('laravel-testimonials::testimonials.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_testimonial()
    {
        $this->authenticateAsAdmin();
        $testimonial = factory(Testimonial::class)->create();

        $attributes = ([
            'name' => 'test title updated',
            'body' => 'test body updated',
            'profession' => 'test profession',
          ]);

        $response = $this->followingRedirects()
                         ->put('/testimonials/'.$testimonial->id, $attributes);
        $response->assertViewIs('laravel-testimonials::testimonials.index')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_does_not_update_invalid_testimonial()
    {
        $this->authenticateAsAdmin();

        $testimonial = factory(Testimonial::class)->create();
        $response = $this->put('/testimonials/'.$testimonial->id, []);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_testimonial()
    {
        $this->authenticateAsAdmin();

        $testimonial = factory(Testimonial::class)->create();

        $response = $this->delete('/testimonials/'.$testimonial->id);
        $response->assertRedirect('/testimonials');
    }
}
