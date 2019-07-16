@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Edit testimonial group</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonialGroups.update', $testimonialGroup->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    
                    {{-- Group Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->title,
                            'required' => true,
                        ])
                    </div>
                    
                    {{-- Quotes color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Quotes color',
                            'name' => 'quotes_color',
                            'tooltip' => 'Exadecimal value for the quotes color.',
                            'placeholder' => '#HEX', 
                            'value' => $testimonialGroup->quotes_color,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Max characters --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Max characters',
                            'name' => 'max_characters',
                            'tooltip' => 'Limit the characters shown in the testimonial texts.',
                            'placeholder' => '', 
                            'value' => $testimonialGroup->max_characters,
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Round images --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'show_title',
                              'description' => 'Show title',
                              'value' => $testimonialGroup->show_title,
                              'required' => false,
                        ])
                    </div>
                                        
                    <div class="col-12">
                        @include('laravel-form-partials::buttons-back-submit', [
                           'route' => 'testimonialGroups.index'  
                       ])
                    </div>
                    
                </div>
            </form>
    
    </div>
    
@endsection
