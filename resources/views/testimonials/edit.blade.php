@extends('laravel-testimonials::testimonials.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Edit testimonial</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    
                    {{-- Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => $testimonial->title,
                        ])
                    </div>
                    
                    {{-- Body --}}
                    <div class="col-12">
                        @include('laravel-form-partials::textarea-plain', [
                            'title' =>  'Body',
                            'name' => 'body',
                            'value' => $testimonial->body,
                        ])
                    </div>
                    
                    {{-- Button text --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Button text',
                            'name' => 'button_text',
                            'placeholder' => '', 
                            'value' => $testimonial->button_text,
                        ])
                    </div>
                    
                    {{-- Testimonials group --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Testimonials group",
                              'name' => 'testimonials_group',
                              'placeholder' => "choose one...", 
                              'records' => $testimonialGroupsArray,
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => $testimonial->testimonials_group,
                              'tooltip' => 'Pick the group to show',
                              'required' => false,
                        ])
                    </div>
                    
                    {{-- Flex  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Flex',
                            'name' => 'testimonial_flex',
                            'placeholder' => '', 
                            'value' => $testimonial->testimonial_flex,
                            'required' => true,
                            'tooltip' => 'The flex property applied to the specific testimonial. Eg. 1 0 320px (grow shrink basis) or 0 1 auto',
                        ])
                    </div>
                    
                    {{-- Separator color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Separator color',
                            'name' => 'separator_color',
                            'placeholder' => '', 
                            'value' => $testimonial->separator_color,
                            'required' => true,
                            'tooltip' => 'The color of separator between title and text',
                        ])
                    </div>
                    
                    {{-- Image --}}
                    @include('laravel-form-partials::upload-image', [
                          'title' => 'Testimonial image',
                          'name' => 'image_file_name',
                          'folder' => 'testimonials',
                          'value' => $testimonial->image_file_name,
                    ]) 
                    
                    {{-- Image alt --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Image alt',
                            'name' => 'image_alt',
                            'placeholder' => '', 
                            'value' => $testimonial->image_alt,
                        ])
                    </div>
                    
                    {{-- Icons fontawesome --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icons fontawesome',
                            'name' => 'fontawesome_icon_class',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => 'fa-user-alt', 
                            'value' => $testimonial->fontawesome_icon_class,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Icon color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Icon color',
                            'name' => 'icon_color',
                            'tooltip' => 'Font awesome icon color.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonial->icon_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Button Url --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Button Url',
                            'name' => 'button_url',
                            'tooltip' => '',
                            'placeholder' => 'https://...', 
                            'value' => $testimonial->button_url,
                            'required' => false,
                        ])
                    </div>
                    
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                            'route' => 'testimonials.index'  
                        ])
                    </div>
                </div>
            </form>
    
    </div>
    
@endsection
