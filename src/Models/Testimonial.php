<?php

namespace DavideCasiraghi\LaravelTestimonials\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    use Translatable;

    public $translatedAttributes = ['name', 'body', 'profession'];
    protected $fillable = [
        'testimonials_group',
        'gender',
        'image_file_name',
    ];
}
