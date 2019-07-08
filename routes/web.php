<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelTestimonials\Http\Controllers', 'middleware' => 'web'], function () {

        /* Testimonials */
        Route::resource('testimonials', 'TestimonialController');

        /* Testimonial translations */
        Route::get('testimonialTranslations/{testimonialId}/{languageCode}/create', 'TestimonialTranslationController@create')->name('testimonialTranslations.create');
        Route::get('testimonialTranslations/{testimonialId}/{languageCode}/edit', 'TestimonialTranslationController@edit')->name('testimonialTranslations.edit');
        Route::post('/testimonialTranslations/store', 'TestimonialTranslationController@store')->name('testimonialTranslations.store');
        Route::put('/testimonialTranslations/update', 'TestimonialTranslationController@update')->name('testimonialTranslations.update');
        Route::delete('/testimonialTranslations/destroy/{testimonialTranslationId}', 'TestimonialTranslationController@destroy')->name('testimonialTranslations.destroy');
    });
