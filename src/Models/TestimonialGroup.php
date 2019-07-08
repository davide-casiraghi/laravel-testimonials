<?php

namespace DavideCasiraghi\LaravelTestimonials\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class TestimonialGroup extends Model
{
    protected $table = 'testimonial_groups';

    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = [
        'quotes_color',
        'max_characters',
        'show_title',
    ];
}
