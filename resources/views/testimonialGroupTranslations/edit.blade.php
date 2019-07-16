@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')
    
    <div class="row py-4">
        <div class="col-12 col-sm-9">
            <h4>Edit testimonial translation</h4>
        </div>
        <div class="col-12 col-sm-3 text-right">
            <span class="badge badge-secondary">{{$selectedLocaleName}}</span>
        </div>
    </div>

    @include('laravel-form-partials::error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('testimonialGroupTranslations.update', $testimonialGroupTranslation->id) }}" method="POST">
        @csrf
        @method('PUT')
            @include('laravel-form-partials::input-hidden', [
                  'name' => 'testimonial_group_translation_id',
                  'value' => $testimonialGroupTranslation->id,
            ])
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
                    'value' => $testimonialGroupTranslation->title,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::textarea-plain', [
                    'title' =>  'Description',
                    'name' => 'description',
                    'value' => $testimonialGroupTranslation->description,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Button text',
                    'name' => 'button_text',
                    'placeholder' => '', 
                    'value' => $testimonialGroupTranslation->button_text,
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-form-partials::input', [
                    'title' =>  'Image alt',
                    'name' => 'image_alt',
                    'placeholder' => '', 
                    'value' => $testimonialGroupTranslation->image_alt,
                    'required' => true,
                ])
            </div>
        </div>
        
        <div class="row mt-2">  
            <div class="col-12 action">
                @include('laravel-form-partials::buttons-back-submit', [
                    'route' => 'testimonials.index'  
                ])
    </form>

                <form action="{{ route('testimonialGroupTranslations.destroy',$testimonialGroupTranslation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link pl-0">Delete translation</button>
                </form>
            </div>
        </div>

@endsection        
        
