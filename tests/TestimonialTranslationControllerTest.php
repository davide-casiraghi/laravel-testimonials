<?php

namespace DavideCasiraghi\LaravelTestimonials\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelTestimonials\Models\Testimonial;

class TestimonialTranslationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_the_testimonial_translation_create_page()
    {
        $this->authenticateAsAdmin();

        $testimonialId = 1;
        $languageCode = 'es';

        $this->get('/testimonialTranslations/'.$testimonialId.'/'.$languageCode.'/create')
            ->assertViewIs('laravel-testimonials::testimonialsTranslations.create')
            ->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_valid_testimonial_translation()
    {
        $this->authenticateAsAdmin();

        $testimonial = factory(Testimonial::class)->create();
        
        $data = [
            'testimonial_id' => $testimonial->id,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/testimonialTranslations/store', $data);

        $this->assertDatabaseHas('testimonial_translations', ['locale' => 'es', 'name' => 'Spanish testimonial name']);
        $response->assertViewIs('laravel-testimonials::testimonials.index');
    }

    /** @test */
    public function it_does_not_store_invalid_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $response = $this
            ->followingRedirects()
            ->post('/testimonialTranslations/store', []);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_displays_the_event_testimonial_translation_edit_page()
    {
        $this->authenticateAsAdmin();
        $testimonial = factory(Testimonial::class)->create();

        $data = [
            'testimonial_id' => $testimonial->id,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name',
        ];

        $this->post('/testimonialTranslations/store', $data);

        $response = $this->get('/testimonialTranslations/'.$testimonial->id.'/'.'es'.'/edit');
        $response->assertViewIs('laravel-testimonials::testimonialsTranslations.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonial = factory(Testimonial::class)->create([
                            'name' => 'Testimonial 1',
                        ]);

        $data = [
            'testimonial_id' => $testimonial->id,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name',
        ];

        $this->post('/testimonialTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'testimonial_translation_id' => 2,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name updated',
          ]);
        $response = $this->followingRedirects()
                         ->put('/testimonialTranslations/update', $attributes);
        $response->assertViewIs('laravel-testimonials::testimonials.index')
                 ->assertStatus(200);
        $this->assertDatabaseHas('testimonial_translations', ['locale' => 'es', 'name' => 'Spanish testimonial name updated']);
    }

    /** @test */
    public function it_does_not_update_invalid_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonial = factory(Testimonial::class)->create();

        $data = [
            'testimonial_id' => $testimonial->id,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name',
        ];

        $this->post('/testimonialTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'testimonial_translation_id' => 2,
            'language_code' => 'es',
            'name' => '',
          ]);
        $response = $this->followingRedirects()
                         ->put('/testimonialTranslations/update', $attributes);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonial = factory(Testimonial::class)->create();

        $data = [
            'testimonial_id' => $testimonial->id,
            'language_code' => 'es',
            'name' => 'Spanish testimonial name',
        ];

        $this->post('/testimonialTranslations/store', $data);

        $response = $this->delete('/testimonialTranslations/destroy/2');
        $response->assertRedirect('/testimonials');
    }
}
