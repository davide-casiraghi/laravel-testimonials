<?php

namespace DavideCasiraghi\LaravelTestimonials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DavideCasiraghi\LaravelTestimonials\Skeleton\SkeletonClass
 */
class LaravelTestimonials extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-testimonials';
    }
}
