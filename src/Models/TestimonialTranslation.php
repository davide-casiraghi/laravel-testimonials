<?php

namespace DavideCasiraghi\LaravelTestimonials\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model
{
    protected $table = 'testimonial_translations';

    public $timestamps = false;
    protected $fillable = [
        'testimonial_id',
        'name',
        'body',
        'profession',
        'locale',
    ];
}
