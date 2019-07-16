@extends('laravel-testimonials::testimonialGroups.layout')

@section('content')

    <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Add new testimonial group</h4>
                </div>
            </div>

            @include('laravel-form-partials::error-management', [
                  'style' => 'alert-danger',
            ])

            <form action="{{ route('testimonialGroups.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    
                    {{-- Group Title  --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' => 'Title',
                            'name' => 'title',
                            'placeholder' => '', 
                            'value' => old('title'),
                            'required' => true,
                        ])
                    </div>
                    
                    {{-- Quotes color --}}
                    <div class="col-12">
                        @include('laravel-form-partials::select', [
                              'title' => "Quotes color",
                              'name' => 'quotes_color',
                              'placeholder' => "choose one...", 
                              'records' => [
                                 'red' => 'Red',
                                 'pink' => 'Pink',
                                 'purple' => 'Purple',
                                 'deeppurple' => 'Deep purple',
                                 'indigo' => 'Indigo',
                                 'blue' => 'Blue',
                                 'lightblue' => 'Light blue',
                                 'cyan' => 'Cyan',
                                 'teal' => 'Teal',
                                 'green' => 'Green',
                                 'lightgreen' => 'Light green',
                                 'lime' => 'Lime',
                                 'yellow' => 'Yellow',
                                 'amber' => 'Amber',
                                 'orange' => 'Orange',
                                 'deeporange' => 'Deep orange',
                                 'brown' => 'Brown',
                                 'grey' => 'Grey',
                                 'bluegrey' => 'Blue grey',
                                 'black' => 'Black',
                                 'white' => 'White',
                              ],      
                              'liveSearch' => 'false',
                              'mobileNativeMenu' => true,
                              'selected' => old('quotes_color'),
                              'required' => false,
                              'tooltip' => 'Exadecimal value for the quotes color',
                        ])
                    </div>
                    
                    {{-- Max characters --}}
                    <div class="col-12">
                        @include('laravel-form-partials::input', [
                            'title' =>  'Max characters',
                            'name' => 'max_characters',
                            'tooltip' => 'Limit the characters shown in the testimonial texts.',
                            'placeholder' => '', 
                            'value' => old('max_characters'),
                            'required' => false,
                        ])
                    </div>
                    
                    {{-- Round images --}}
                    <div class="col-12">
                        @include('laravel-form-partials::checkbox', [
                              'name' => 'show_title',
                              'description' => 'Show title',
                              'value' => old('show_title'),
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
