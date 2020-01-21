<?php

namespace DavideCasiraghi\LaravelTestimonials\Tests;

use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup;
use Illuminate\Foundation\Testing\WithFaker;

class TestimonialGroupTranslationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_the_testimonial_group_translation_create_page()
    {
        $this->authenticateAsAdmin();

        $testimonialGroupId = 1;
        $languageCode = 'es';

        $this->get('/testimonialGroupTranslations/'.$testimonialGroupId.'/'.$languageCode.'/create')
            ->assertViewIs('laravel-testimonials::testimonialGroupTranslations.create')
            ->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_valid_testimonial_group_translation()
    {
        $this->authenticateAsAdmin();

        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $data = [
            'testimonial_group_id' => $testimonialGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/testimonialGroupTranslations/store', $data);

        $this->assertDatabaseHas('testimonial_group_translations', ['locale' => 'es', 'title' => 'Spanish testimonial group title']);
        $response->assertViewIs('laravel-testimonials::testimonialGroups.index');
    }

    /** @test */
    public function it_does_not_store_invalid_testimonial_group_translation()
    {
        $this->authenticateAsAdmin();
        $response = $this
            ->followingRedirects()
            ->post('/testimonialGroupTranslations/store', []);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_displays_the_event_testimonial_translation_edit_page()
    {
        $this->authenticateAsAdmin();
        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $data = [
            'testimonial_group_id' => $testimonialGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title',
        ];

        $this->post('/testimonialGroupTranslations/store', $data);

        $response = $this->get('/testimonialGroupTranslations/'.$testimonialGroup->id.'/'.'es'.'/edit');
        $response->assertViewIs('laravel-testimonials::testimonialGroupTranslations.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonialGroup = factory(TestimonialGroup::class)->create([
            'title' => 'Testimonial 1',
        ]);

        $data = [
            'testimonial_group_id' => $testimonialGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title',
        ];

        $this->post('/testimonialGroupTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'testimonial_group_translation_id' => 2,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title updated',
        ]);
        $response = $this->followingRedirects()
                         ->put('/testimonialGroupTranslations/update', $attributes);
        $response->assertViewIs('laravel-testimonials::testimonialGroups.index')
                 ->assertStatus(200);
        $this->assertDatabaseHas('testimonial_group_translations', ['locale' => 'es', 'title' => 'Spanish testimonial group title updated']);
    }

    /** @test */
    public function it_does_not_update_invalid_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $data = [
            'testimonial_group_id' => $testimonialGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title',
        ];

        $this->post('/testimonialGroupTranslations/store', $data);

        // Update the translation
        $attributes = ([
            'testimonial_group_translation_id' => 2,
            'language_code' => 'es',
            'title' => '',
        ]);
        $response = $this->followingRedirects()
                         ->put('/testimonialGroupTranslations/update', $attributes);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_testimonial_translation()
    {
        $this->authenticateAsAdmin();
        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $data = [
            'testimonial_group_id' => $testimonialGroup->id,
            'language_code' => 'es',
            'title' => 'Spanish testimonial group title',
        ];

        $this->post('/testimonialGroupTranslations/store', $data);

        $response = $this->delete('/testimonialGroupTranslations/destroy/2');
        $response->assertRedirect('/testimonialGroups');
    }
}
