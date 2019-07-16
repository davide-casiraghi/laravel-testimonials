<?php

    Route::group(['namespace' => 'DavideCasiraghi\LaravelTestimonials\Http\Controllers', 'middleware' => 'web'], function () {

        /* Testimonial Groups */
        Route::resource('testimonialGroups', 'TestimonialGroupController');

        /* Testimonial Group translations */
        Route::get('testimonialGroupTranslations/{testimonialGroupId}/{languageCode}/create', 'TestimonialGroupTranslationController@create')->name('testimonialGroupTranslations.create');
        Route::get('testimonialGroupTranslations/{testimonialGroupId}/{languageCode}/edit', 'TestimonialGroupTranslationController@edit')->name('testimonialGroupTranslations.edit');
        Route::post('/testimonialGroupTranslations/store', 'TestimonialGroupTranslationController@store')->name('testimonialGroupTranslations.store');
        Route::put('/testimonialGroupTranslations/update', 'TestimonialGroupTranslationController@update')->name('testimonialGroupTranslations.update');
        Route::delete('/testimonialGroupTranslations/destroy/{testimonialGroupTranslationId}', 'TestimonialGroupTranslationController@destroy')->name('testimonialGroupTranslations.destroy');

        /* Testimonials */
        Route::resource('testimonials', 'TestimonialController');

        /* Testimonial translations */
        Route::get('testimonialTranslations/{testimonialId}/{languageCode}/create', 'TestimonialTranslationController@create')->name('testimonialTranslations.create');
        Route::get('testimonialTranslations/{testimonialId}/{languageCode}/edit', 'TestimonialTranslationController@edit')->name('testimonialTranslations.edit');
        Route::post('/testimonialTranslations/store', 'TestimonialTranslationController@store')->name('testimonialTranslations.store');
        Route::put('/testimonialTranslations/update', 'TestimonialTranslationController@update')->name('testimonialTranslations.update');
        Route::delete('/testimonialTranslations/destroy/{testimonialTranslationId}', 'TestimonialTranslationController@destroy')->name('testimonialTranslations.destroy');
    });
