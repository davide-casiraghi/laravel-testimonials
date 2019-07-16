<?php

namespace DavideCasiraghi\LaravelTestimonials\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup;

class TestimonialGroupControllerTest extends TestCase
{
    use WithFaker;

    /***************************************************************/

    /** @test */
    public function it_runs_the_test_testimonial_group_factory()
    {
        $testimonialGroup = factory(TestimonialGroup::class)->create([
                            'title' => 'test title',
                        ]);
        $this->assertDatabaseHas('testimonial_group_translations', [
                                'locale' => 'en',
                                'title' => 'test title',
                ]);
    }

    /** @test */
    public function it_displays_the_testimonial_groups_index_page()
    {
        $this->authenticateAsAdmin();
        $this->get('testimonialGroups')
            ->assertViewIs('laravel-testimonials::testimonialGroups.index')
            ->assertStatus(200);
    }

    /** @test */
    public function it_displays_the_testimonial_group_create_page()
    {
        $this->authenticateAsAdmin();

        $this->get('testimonialGroups/create')->dump();
            //->assertViewIs('laravel-testimonials::testimonialGroups.create')
            //->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_valid_testimonial_group()
    {
        $this->authenticateAsAdmin();

        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'button_text' => 'test button text',
            'image_alt' => 'test image alt',
            'bkg_color' => '#2365AA',
            'group_title_color' => '#2365AA',
            'group_title_font_size' => '2rem',
            'testimonial_title_color' => '#2365AA',
            'testimonial_title_font_size' => '2rem',
            'description_font_size' => '2rem',
            'link_style' => 2,
            'button_url' => 'http://www.google.it',
            'button_color' => '#2365AA',
            'button_corners' => '2rem',
            'background_type' => '2rem',
            'opacity' => '2rem',
            'background_image' => 'test_bkg_image.jpg',
            'background_image_position' => 2,
            'justify_content' => '2rem',
            'flex_wrap' => '2rem',
            'flex_flow' => '2rem',
            'testimonials_flex' => '2rem',
            'testimonials_padding' => '10px',
            'testimonials_box_sizing' => '2rem',
            'testimonials_round_images' => 1,
            'testimonials_images_width' => '200px',
            'testimonials_images_hide_mobile' => 0,
            'icons_size' => '100px',
        ];

        $response = $this
            ->followingRedirects()
            ->post('/testimonialGroups', $data);

        $this->assertDatabaseHas('testimonial_groups', ['background_image' => 'test_bkg_image.jpg']);
        $response->assertViewIs('laravel-testimonials::testimonialGroups.index');
    }

    /** @test */
    public function it_does_not_store_invalid_testimonial_group()
    {
        $this->authenticateAsAdmin();
        $response = $this->post('/testimonialGroups', []);
        $response->assertSessionHasErrors();
        $this->assertNull(TestimonialGroup::first());
    }

    /** @test */
    /*public function it_displays_the_testimonial_group_show_page()
    {
        $this->authenticate();

        $testimonialGroup = factory(TestimonialGroup::class)->create();
        $response = $this->get('/testimonialGroups/'.$testimonialGroup->id);
        $response->assertViewIs('laravel-testimonials::testimonialGroups.show')
                 ->assertStatus(200);
    }*/

    /** @test */
    public function it_displays_the_testimonial_group_edit_page()
    {
        $this->authenticateAsAdmin();

        $testimonialGroup = factory(TestimonialGroup::class)->create();
        $response = $this->get("/testimonialGroups/{$testimonialGroup->id}/edit");
        $response->assertViewIs('laravel-testimonials::testimonialGroups.edit')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_updates_valid_testimonial_group()
    {
        $this->authenticateAsAdmin();
        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $attributes = ([
            'title' => 'test title updated',
            'description' => 'test description updated',
          ]);

        $response = $this->followingRedirects()
                         ->put('/testimonialGroups/'.$testimonialGroup->id, $attributes);
        $response->assertViewIs('laravel-testimonials::testimonialGroups.index')
                 ->assertStatus(200);
    }

    /** @test */
    public function it_does_not_update_invalid_testimonial_group()
    {
        $this->authenticateAsAdmin();

        $testimonialGroup = factory(TestimonialGroup::class)->create();
        $response = $this->put('/testimonialGroups/'.$testimonialGroup->id, []);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_deletes_testimonial_group()
    {
        $this->authenticateAsAdmin();

        $testimonialGroup = factory(TestimonialGroup::class)->create();

        $response = $this->delete('/testimonialGroups/'.$testimonialGroup->id);
        $response->assertRedirect('/testimonialGroups');
    }
}
