@extends('laravel-testimonials::testimonials.layout')

@section('content')
    
    <div class="row py-4">
        <div class="col-12 col-sm-9">
            <h4>Add new testimonial group translation</h4>
        </div>
        <div class="col-12 col-sm-3 text-right">
            <span class="badge badge-secondary">{{$selectedLocaleName}}</span>
        </div>
    </div>

    @include('laravel-form-partials::error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('testimonialGroupTranslations.store') }}" method="POST">
        @csrf

            @include('laravel-form-partials::input-hidden', [
                  'name' => 't_group_id',
                  'value' => $testimonialGroupId,
            ])
            @include('laravel-form-partials::input-hidden', [
                  'name' => 'language_code',
                  'value' => $languageCode
            ])

         <div class="row">
            
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Title',
                    'name' => 'title',
                    'placeholder' => '', 
                    'value' => old('title'),
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::textarea-plain', [
                    'title' =>  'Description',
                    'name' => 'description',
                    'value' => old('description'),
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Button text',
                    'name' => 'button_text',
                    'placeholder' => '', 
                    'value' => old('button_text'),
                    'required' => true,
                ])
            </div>
            
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Image alt',
                    'name' => 'image_alt',
                    'placeholder' => '', 
                    'value' => old('image_alt'),
                    'required' => true,
                ])
            </div>
                
        </div>

        @include('laravel-form-partials::buttons-back-submit', [
            'route' => 'testimonialGroups.index'  
        ])

    </form>

@endsection
