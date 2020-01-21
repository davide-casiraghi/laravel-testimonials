<?php

namespace DavideCasiraghi\LaravelTestimonials\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TestimonialGroup extends Model
{
    protected $table = 'testimonial_groups';

    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = [
        'quotes_color',
        'max_characters',
        'show_title',
        'title_alignment',
    ];
}
