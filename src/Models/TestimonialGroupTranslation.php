<?php

namespace DavideCasiraghi\LaravelTestimonials\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialGroupTranslation extends Model
{
    protected $table = 'testimonial_group_translations';

    public $timestamps = false;
    protected $fillable = [
        't_group_id',
        'title',
        'locale',
    ];
}
